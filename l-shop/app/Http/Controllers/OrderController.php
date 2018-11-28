<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GoodsSku;
use App\Models\Goods;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderGoods;
use Validator;
use DB;

class OrderController extends Controller
{
    
    // 查询订单
    public function index(Request $req) {

            // 处理参数
            $perPage = max(1, (int)$req->per_page);

            // with : 取出关联表中的数据
            $data = Order::with('goods')
                    ->where('member_id', $req->jwt->id)
                    ->orderBy('id', 'desc')
                    ->paginate( $perPage );

        return ok($data);
    }


    // 下订单
    public function insert(Request $req) {
        /*  步骤一、表单验证    */
        $validator = Validator::make($req->all(), [
            'address_id'=>'required',
            'goods'=>'required|json',
        ]);
        if($validator->fails())
        {
            // 获取错误信息
            $errors = $validator->errors();
            // 返回 JSON 对象以及 422 的状态码
            return error($errors, 422);
        }

        // 根据收件人ID查询出收货人信息
        $address = Address::find($req->address_id);
        if(!$address)
        {
            // 返回 JSON 对象以及 422 的状态码
            return error([
                'address'=>'无效的收件人地址'
            ], 422);
        }

        /* 步骤二、验证购物车中商品的库存量并计算总价   */
        $goodsInfo = json_decode($req->goods, TRUE);
        // 循环要购买的每件商品，检查库存量，同时再计算出总价
        $totalFee = 0;
        foreach($goodsInfo as $k => $v)
        {
            $skuInfo = GoodsSku::select('stock','price','goods_id')->find($v['sku_id']);
            if($skuInfo->stock > $v['buy_count'])
            {
                $totalFee += $skuInfo->price * $v['buy_count'];
                // 把这件商品的 price 和 goods_id 放到购物车这个数组中，后面下订单时要使用
                $goodsInfo[$k]['price'] = $skuInfo->price;
                $goodsInfo[$k]['goods_id'] = $skuInfo->goods_id;
            }
            else
            {
                return error('库存量不足！', 403);
            }
        }

        /* 步骤三、生成订单号并构造下订单的信息  */
        $sn = getOrderSn();
        $data = [
            'sn' => $sn,
            'name' => $address->name,
            'tel' => $address->tel,
            'province' => $address->province,
            'city' => $address->city,
            'area' => $address->area,
            'address' => $address->address,
            'total_fee' => $totalFee,
            'member_id' => $req->jwt->id,
            'status' => 0,
        ];

        // var_dump($goodsInfo);
        // die;
        /* 步骤四、开启事务   */
        DB::beginTransaction();

        /* 步骤五、向订单的基本信息保存到 订单表  */
        $order = Order::create($data);
        if($order)
        {
            /* 步骤六、把购物车中的商品保存到 订单商品表中 */
            $_cartData = [];
            // 循环购物车中的商品
            foreach($goodsInfo as $v)
            {
                $_cartData[] = new OrderGoods([
                    'sku_id' => $v['sku_id'],
                    'goods_id' => $v['goods_id'],
                    'price' => $v['price'],
                    'goods_count' => $v['buy_count'],
                ]);
                /* 步骤七、减少相应商品的库存量 */
                if(!GoodsSku::where('id', $v['sku_id'])->decrement('stock', $v['buy_count']))
                {
                    DB::rollBack();
                    return error('下单失败！', 500);
                }
            }

            // 循环购物车中的商品，插入到订单商品表中
            // $order->goods() ：取出订单模型所关联的模型
            // 向关联模型中一次插入多条记录

            if(!$order->goods()->saveMany($_cartData))
            {
                DB::rollBack();
                return error('下单失败！', 500);
            }
            else
            {
                DB::commit();
                return ok($order);
            }
        }
        else
        {
            DB::rollBack();
            return error('下单失败，请重试', 500);
        }
    }
}
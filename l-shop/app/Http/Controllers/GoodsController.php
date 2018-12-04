<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\GoodsSku;

class GoodsController extends Controller
{
    
    public function index(Request $req) {

        /**
         * first()  :   取一条记录
         * get()    :   多条
         * paginate :   翻页
         */

        
        if($req->id) {

            $id = max(1, (int)$req->id);
            $data = Goods::with('attirubtes','images','skus')
                    ->where('id', $id)
                    ->where('is_on_sale','y')
                    ->first();

            if($data) 
                return ok($data);
            else 
                return error('商品不存在', 404);

        } else if($req->sku_ids){
            $data = GoodsSku::with('goods')
                ->whereIn('id',explode(',',$req->sku_ids))
                ->get();
            if($data){
                return ok($data);
            }else{
                return error('商品不存在',404);
            } 
        }
         else {

            // 处理参数
            $perPage = max(1, (int)$req->per_page);
            $sortBy = ($req->sortby=='id' || $req->sortby=='created_at') ? $req->sortby : 'id';
            $order = ($req->order == 'asc' || $req->order == 'desc') ? $req->order : 'desc';

            // with : 取出关联表中的数据
            $data = Goods::with('attirubtes','images','skus')
                    ->where('goods_name', 'like', '%'.$req->keywords.'%')
                    ->where('is_on_sale', 'y')
                    ->orderBy($sortBy, $order)
                    ->paginate( $perPage );
        }

        return $data;
    }
}

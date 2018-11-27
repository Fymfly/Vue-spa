<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Address;

class AddressController extends Controller
{
    
    // 显示收货地址
    public function index(Request $req) {

        // 根据会员id取出收货地址
        $data = Address::where('member_id',$req->jwt->id)->get();

        return ok($data);
    }

    // 添加收货地址
    public function insert(Request $req) { 
        // 生成验证器对象
        // 参数一、表单中的数据
        // 参数二、验证规则
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'tel'=>'required|regex:/^1[34578][0-9]{9}$/',
            'province'=>'required',
            'city'=>'required',
            'area'=>'required',
            'address'=>'required',
            'is_default'=>'required|min:0|max:1',
        ]);

        // 如果失败
        if($validator->fails())
        {
            // 获取错误信息
            $errors = $validator->errors();
            // 返回 JSON 对象以及 422 的状态码
            return error($errors, 422);
        }
 
        // 插入数据库
        // 返回值：插入成功之后那条记录的对象

        $data = $req->all();      // 接收表单中的数据

        // 我们会在中间件中解析令牌，并且把令牌保存到 Request 对象中的 jwt 属性上
        // 所以我们可以从 $req->jwt->id 获取到解析出来的会员id
        $data['member_id'] = $req->jwt->id;

        $address = Address::create($data);

        return ok($address);

    }
}

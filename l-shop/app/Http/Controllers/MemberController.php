<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT;

class MemberController extends Controller
{
    
    // 下订单
    public function order(Request $req) {

        // 获取令牌中的数据

        echo $req->jwt->id;
    }

    // 注册
    public function insert(Request $req) { 
        // 生成验证器对象
        // 参数一、表单中的数据
        // 参数二、验证规则
        $validator = Validator::make($req->all(), [
            'username'=>'required|min:6|max:18|unique:members',
            'password'=>'required|min:6|max:18|confirmed',
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
        $member = Member::create([
            'username' => $req->username,
            'password' => bcrypt($req->password),
        ]);

        return ok($member);

    }



    // 登录
    public function login(Request $req) {

        $validator = Validator::make($req->all(), [
            'username'=>'required|min:6|max:18',
            'password'=>'required|min:6|max:18',
        ]);

        // 如果失败
        if($validator->fails())
        {
            // 获取错误信息
            $errors = $validator->errors();
            // 返回 JSON 对象以及 422 的状态码
            return error($errors, 422);
        }


        // 根据用户名查询账号是否存在（只查询一条用 first 方法）SELECT * FROM
        $member = Member::select('id','password')->where('username',$req->username)->first();
        if($member) {

            // 判断密码
            if(Hash::check($req->password, $member->password)) {

                // 把用户的信息保存到 令牌（JWT）中，然后把令牌发给前端

                // 获取当前时间
                $now = time();

                // 读取秘钥
                $key = env('JWT_KEY');
                $expire = $now + env('JWT_EXPIRE');

                // 定义令牌中的数据
                $data = [
                    'iat' => $now,      // 当前时间
                    'exp' => $expire,    // 过期时间
                    'id' => $member->id,
                ];
                // 生成令牌
                $jwt = JWT::encode($data,$key);

                // 发给前端
                return ok([
                    'ACCESS_TOKEN' => $jwt, 
                ]);
            } else {

                return error('密码不正确', 400);
            }
        } else {

            return error('用户名不存在', 404);
        }

    }


}
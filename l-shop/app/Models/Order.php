<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = ['sn','name','tel','province','city','area','address','total_fee','member_id','status'];

    // 关联 order_goods 表
    public function goods() {

        return $this->hasMany('App\Models\OrderGoods', 'order_id');
    }
}

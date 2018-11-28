<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    
    protected $table = 'order_goods';
    public $timestamps = false;
    protected $fillable = ['sku_id','goods_id','price','goods_count','order_id'];

    // 关联到订单
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}

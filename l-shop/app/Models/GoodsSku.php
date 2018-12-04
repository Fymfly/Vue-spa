<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSku extends Model
{

    protected $table = 'goods_sku';
    public $timestamps = false;

    // 关联商品SKU表
    public function goods(){
        
        return $this->belongsTo('App\Models\Goods','goods_id');
    }

}

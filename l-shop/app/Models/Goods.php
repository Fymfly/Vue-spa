<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    
    protected $table = 'goods';
    public $timestamps = true;

    // 属性表
    public function attirubtes() {

        return $this->hasMany('App\Models\GoodsAttirubte', 'goods_id');
    }

    // 图片表
    public function images() {

        return $this->hasMany('App\Models\GoodsImage', 'goods_id');
    }

    // sku 表
    public function skus() {

        return $this->hasMany('App\Models\GoodsSku', 'goods_id');
    }
}

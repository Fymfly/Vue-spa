<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsAttirubte extends Model
{
    
    protected $table = 'goods_attirubte';
    public $timestamps = false;


    // 关联商品表
    public function goods() {

        return $this->belongsTo('App\Models\Goods', 'goods_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsImage extends Model
{
    
    protected $table = 'goods_image';
    public $timestamps = true;

    // 关联商品图片表
    public function goods() {

        return $this->belongsTo('App\Models\GoodsImage', 'goods_id');
    }
}

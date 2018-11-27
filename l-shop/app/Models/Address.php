<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    public $timestamps = false;

    protected $fillable = ['name','tel','province','city','area','address','is_default','member_id'];
}

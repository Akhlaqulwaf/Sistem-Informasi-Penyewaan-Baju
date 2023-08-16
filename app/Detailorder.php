<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detailorder extends Model
{
    protected $table = 'detail_order';
    protected $fillable = ['order_id','product_id','product_attributes_id','durasi','tgl_mulai','tgl_selesai','qty'];
}

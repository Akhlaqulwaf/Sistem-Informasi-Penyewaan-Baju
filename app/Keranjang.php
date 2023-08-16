<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $fillable = ['user_id','products_id','product_attributes_id','durasi','tgl_mulai','tgl_selesai','qty'];
}

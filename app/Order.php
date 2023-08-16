<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['invoice','user_id','status_order_id','metode_pembayaran','subtotal','pesan'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    
    protected $table = 'gambar';
    protected $fillable = ['product_id','gambar'];
}

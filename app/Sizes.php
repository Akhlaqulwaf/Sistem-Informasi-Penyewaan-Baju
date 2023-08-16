<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['name','products_id'];
}

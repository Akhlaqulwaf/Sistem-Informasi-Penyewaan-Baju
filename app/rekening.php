<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rekening extends Model
{
    protected $table = 'rekening';
    protected $fillable = ['bank_name','atas_nama','no_rekening'];
}

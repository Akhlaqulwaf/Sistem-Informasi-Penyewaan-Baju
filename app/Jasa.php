<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    protected $table = 'jasas';
    protected $fillable = ['jasa_code','name','image','description','price'];

    public function attributes()
    {
        return $this->hasMany('App\JasaAttribute','jasa_id');
    }
}

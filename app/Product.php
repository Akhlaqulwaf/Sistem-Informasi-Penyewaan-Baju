<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_code','name','image','image1','image2','image3','description','price','categories_id','stok'];

    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute','product_id');
    }

	public function gambar()
    {
        return $this->hasMany('App\Gambar','product_id');
    }
    
    public function scopePopular($query, $limit = 10)
	{
		$month = now()->format('m');

		return $query->selectRaw('products.*, COUNT(detail_order.id) as total_sold')
			->join('detail_order', 'detail_order.product_id', '=', 'products.id')
			->join('order', 'detail_order.order_id', '=', 'order.id')
			->whereRaw(
				'order.status_order_id = :order_satus AND MONTH(order.created_at) = :month',
				[
					'order_status' => '7',
					'month' => $month
				]
			)
			->groupBy('products.id')
			->orderByRaw('total_sold DESC')
			->limit($limit);
	}

    
}

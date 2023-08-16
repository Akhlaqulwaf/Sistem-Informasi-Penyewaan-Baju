<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        //menampilkan data produk dihalamam utama user dengan limit 10 data
        //untuk di carousel
         $month = now()->format('m');
         $data = array(
             'produks' => DB::table('products')->selectRaw('products.*, COALESCE(sum(detail_order.qty),0) as total_sold')
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
		 	->limit(10)
		 	->get(),
         );

        return view('user.welcome',$data);
    }

    public function kontak()
    {
        return view('user.kontak');
    }

    
}

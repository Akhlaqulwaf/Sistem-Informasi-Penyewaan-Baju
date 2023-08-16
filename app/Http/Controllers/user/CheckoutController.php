<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckoutController extends Controller
{
    public function index()
    {
        //ambil session user id
        $id_user = \Auth::user()->id;
        //ambil produk apa saja yang akan dibeli user dari table keranjang
        $keranjangs = DB::table('keranjang')
                            ->join('users','users.id','=','keranjang.user_id')
                            ->join('products','products.id','=','keranjang.products_id')
                            ->join('product_attributes','product_attributes.id', '=', 'keranjang.product_attributes_id')
                            ->select('products.name as nama_produk','products.image','users.name','keranjang.*','products.price','products.diskon','product_attributes.harga','product_attributes.size', 'users.alamat', 'users.jaminan', 'users.nomor_hp')
                            ->where('keranjang.user_id','=',$id_user)
                            ->get();

        
    
        //lalu ambil alamat user untuk ditampilkan di view
        $alamat_toko = DB::table('alamat_toko')
        ->join('cities','cities.city_id','=','alamat_toko.city_id')
        ->join('provinces','provinces.province_id','=','cities.province_id')
        ->select('alamat_toko.*','cities.title as kota','provinces.title as prov')
        ->first();

        //lalu ambil alamat user untuk ditampilkan di view
        $users = DB::table('users')
        ->select('users.*', 'users.alamat', 'users.jaminan', 'users.nomor_hp')
        ->where('users.id','=',$id_user)
        ->first();
        
        //buat kode invoice sesua tanggalbulantahun dan jam
        $data = [
            'invoice' => 'ALV'.Date('Ymdhi'),
            'keranjangs' => $keranjangs,
            'alamat_toko' => $alamat_toko,
            'users' => $users
        ];
        return view('user.checkout',$data);
    }
}

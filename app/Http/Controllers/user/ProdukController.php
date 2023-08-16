<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Categories;
use App\Gambar;
use Illuminate\Support\Facades\DB;
class ProdukController extends Controller
{
    public function index()
    {
        //menampilkan data produk yang dijoin dengan table kategori
        //kemudian dikasih paginasi 9 data per halaman nya
        $kat = DB::table('categories')
                ->join('products','products.categories_id','=','categories.id')
                ->select(DB::raw('count(products.categories_id) as jumlah, categories.*'))
                ->groupBy('categories.id')
                ->get();
        
        $produk = DB::table('products')
                ->select('products.*')
                ->paginate(9);

        $attr = DB::table('product_attributes')
                ->get();

        //->groupBy('product_attributes.product_id')                ->join('product_attributes','product_attributes.product_id','=','products.id')

        $data = array(
            'produks' => $produk,
            'categories' => $kat,
            'attr' => $attr
        );
        return view('user.produk',$data);
    }
    public function detail($id)
    {
        $produkDetails = DB::table('product_attributes')
                        ->join('products','products.id','=','product_attributes.product_id')
                        ->where('product_attributes.product_id','=',$id)
                        ->where('product_attributes.stok','!=',0)
                        ->select('products.name as nama_produk','products.image','products.description as deskripsi','product_attributes.*','products.price')
                        ->get();
        
        $produkAttri = DB::table('product_attributes')
                        ->join('products','products.id','=','product_attributes.product_id')
                        ->where('product_attributes.product_id','=',$id)
                        ->orderByRaw('product_attributes.harga')
                        ->select('products.name as nama_produk','products.image','products.description as deskripsi','product_attributes.*','products.price')
                        ->get();
        
        $length = count($produkAttri);

        $detailOrder = DB::table('detail_order')
                        ->select('detail_order.*')
                        ->where('product_id','=',$id)
                        ->whereNull('tgl_kembali')
                        ->get();
        
        $gambar = DB::table('gambar')
                        ->join('products','products.id','=','gambar.product_id')
                        ->where('gambar.product_id','=',$id)
                        ->select('gambar.*')
                        ->first();
        //mengambil detail produk
        $data = array(
            'produk' => Product::findOrFail($id),
            'gambar' => $gambar,
            'produkAttri' => $produkAttri,
            'length' => $length,
            'product_attributes' => $produkDetails,
            'detail_order' => $detailOrder
        );
        return view('user.produkdetail',$data, ['produkDetails'=>$produkDetails, 'detailOrder'=>$detailOrder]);
    }

    public function cari(Request $request)
    {
        //mencari produk yang dicari user
        $prod  = Product::where('name','like','%' . $request->cari. '%')->paginate(9);
        $total = Product::where('name','like','%' . $request->cari. '%')->count(); 
        $data  = array(
            'produks' => $prod,
            'cari' => $request->cari,
            'total' => $total
        );
        return view('user.cariproduk',$data);

    }
}

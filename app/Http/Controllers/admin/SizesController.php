<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Sizes;
use App\Product;

class SizesController extends Controller
{
    public function index()
    {
        //membawa data produk yang di join dengan table kategori
        $size = DB::table('sizes')
                    ->join('products', 'products.id', '=', 'sizes.products_id')
                    ->select('sizes.*', 'products.name as nama_produk')
                    ->get();
        $data = array(
            'sizes' => $size
        );
        //menampilkan view
        return view('admin.sizes.index',$data);
    }

    //function menampilkan view tambah data
    public function tambah()
    {
        $data = array(
            'product' => Product::all(),
        );
        return view('admin.sizes.tambah');
    }

    public function store(Request $request)
    {
        //Simpan datab ke database    
        Sizes::create([
            'products_id' => $request->products_id,
            'name' => $request->name
        ]);
        
        //lalu reireact ke route admin.categories dengan mengirim flashdata(session) berhasil tambah data untuk manampilkan alert succes tambah data
        return redirect()->route('admin.sizes')->with('status','Berhasil Menambah Size');
    }

    public function update($id,Request $request)
    {
        //ambil data sesuai id dari parameter
        $size = Sizes::FindOrFail($id);
        //lalu ambil apa aja yang mau diupdate
        $size->name = $request->name;

        //lalu simpan perubahan
        $size->save();
        return redirect()->route('admin.sizes')->with('status','Berhasil Mengubah Attribute Size');
    }

    //function menampilkan form edit
    public function edit($id)
    {
        $data = array(
            'size' => $size = Sizes::FindOrFail($id)
        );
        return view('admin.sizes.edit',$data);
    }

    public function delete($id)
    {
        //hapus data sesuai id dari parameter
        Sizes::destroy($id);
        
        return redirect()->route('admin.sizes')->with('status','Berhasil Mengahapus Attribute Size');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jasa;
use App\Kelompoks;
use App\JasaAttribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JasaController extends Controller
{
    public function index()
    {
        //membawa data produk yang di join dengan table kategori
        $jasas = DB::table('jasas')
                    ->join('kelompoks', 'kelompoks.id', '=', 'jasas.kelompoks_id')
                    ->select('jasas.*', 'kelompoks.name as nama_kategori')
                    ->get();
        $data = array(
            'jasas' => $jasas
        );
        return view('admin.jasa.index',$data);
    }

    public function tambah()
    {
        //menampilkan form tambah kategori

        $data = array(
            'kelompoks' => Kelompoks::all(),
        );
        return view('admin.jasa.tambah',$data);
    }

    public function store(Request $request)
    {
        //menyimpan produk ke database
        if($request->file('image')){
            //simpan foto produk yang di upload ke direkteri public/storage/imageJasa
            $file = $request->file('image')->store('imageJasa','public');
            
            Jasa::create([
                'jasa_code' => $request->jasa_code,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'kelompoks_id' => $request->kelompoks_id,

                'image'          => $file

            ]);

            return redirect()->route('admin.jasa')->with('status','Berhasil Menambah Produk Baru');
        }
    }

    public function edit($id)
    {
        //menampilkan form edit
        //dan mengambil data produk sesuai id dari parameter
        $data = array(
            'jasa' => Jasa::findOrFail($id),
            'kelompoks' => Kelompoks::all(),
        );
        return view('admin.jasa.edit',$data);
    }

    public function update($id,Request $request)
    {
        //ambil data dulu sesuai parameter $Id
        $prod = Jasa::findOrFail($id);

        // Lalu update data nya ke database
        if( $request->file('image')){
            
            Storage::delete('public/'.$prod->image);
            $file = $request->file('image')->store('imagejasa','public');
            $prod->image = $file;
        }

        $prod->jasa_code = $request->jasa_code;
        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->price = $request->price;
        $prod->kelompoks_id = $request->kelompoks_id;
        
        
        $prod->save();

        return redirect()->route('admin.jasa')->with('status','Berhasil Mengubah Kategori');
    }

    public function delete($id)
    {
        //mengahapus produk
        $prod = Jasa::findOrFail($id);
        Jasa::destroy($id);
        Storage::delete('public/'.$prod->image);
        return redirect()->route('admin.jasa')->with('status','Berhasil Mengahapus Produk');
    }

    
}

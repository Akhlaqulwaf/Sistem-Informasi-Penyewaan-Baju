<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Kelompoks;

class KelompoksController extends Controller
{
    public function index()
    {
        //Ambil data kategori dari database
        $data = array(
            'kelompoks' => kelompoks::all()
        );
        //menampilkan view
        return view('admin.kelompoks.index',$data);
    }

    //function menampilkan view tambah data
    public function tambah()
    {
        return view('admin.kelompoks.tambah');
    }

    public function store(Request $request)
    {
        //Simpan datab ke database    
        Kelompoks::create([
            'name' => $request->name
        ]);
        
        //lalu reireact ke route admin.kelompoks dengan mengirim flashdata(session) berhasil tambah data untuk manampilkan alert succes tambah data
        return redirect()->route('admin.kelompoks')->with('status','Berhasil Menambah Kategori');
    }
    
    public function update($id,Request $request)
    {
        //ambil data sesuai id dari parameter
        $kelompok = Kelompoks::FindOrFail($id);
        //lalu ambil apa aja yang mau diupdate
        $kelompok->name = $request->name;

        //lalu simpan perubahan
        $kelompok->save();
        return redirect()->route('admin.kelompoks')->with('status','Berhasil Mengubah Kategori');
    }

    //function menampilkan form edit
    public function edit($id)
    {
        $data = array(
            'kelompok' => $kelompok = kelompoks::FindOrFail($id)
        );
        return view('admin.kelompoks.edit',$data);
    }

    public function delete($id)
    {
        //hapus data sesuai id dari parameter
        Kelompoks::destroy($id);
        
        return redirect()->route('admin.kelompoks')->with('status','Berhasil Mengahapus Kategori');
    }
}

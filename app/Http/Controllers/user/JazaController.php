<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jasa;
use App\Kelompoks;
use Illuminate\Support\Facades\DB;
class JazaController extends Controller
{
    public function index()
    {
        //menampilkan data jaza yang dijoin dengan table kategori
        //kemudian dikasih paginasi 9 data per halaman nya
        $kat = DB::table('kelompoks')
                ->join('Jasas','Jasas.kelompoks_id','=','kelompoks.id')
                ->select(DB::raw('count(Jasas.kelompoks_id) as jumlah, kelompoks.*'))
                ->groupBy('kelompoks.id')
                ->get();
        $data = array(
            'jazas' => Jasa::paginate(9),
            'kelompoks' => $kat
        );
        return view('user.jaza',$data);
    }
    public function detail($id)
    {
        //mengambil detail jaza
        $data = array(
            'jaza' => Jasa::findOrFail($id)
        );
        return view('user.jazadetail',$data);
    }

    public function cari(Request $request)
    {
        //mencari jaza yang dicari user
        $prod  = Jasa::where('name','like','%' . $request->cari. '%')->paginate(9);
        $total = Jasa::where('name','like','%' . $request->cari. '%')->count(); 
        $data  = array(
            'jazas' => $prod,
            'cari' => $request->cari,
            'total' => $total
        );
        return view('user.carijaza',$data);

    }
}

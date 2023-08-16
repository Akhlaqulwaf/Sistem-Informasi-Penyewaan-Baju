<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keranjang;
use Illuminate\Support\Facades\DB;

class KeranjangController extends Controller
{
    public function index()
    {
        
        $id_user = \Auth::user()->id;
        $keranjangs = DB::table('keranjang')
                            ->join('users','users.id','=','keranjang.user_id')
                            ->join('products','products.id','=','keranjang.products_id')
                            ->join('product_attributes','product_attributes.id', '=', 'keranjang.product_attributes_id')
                            ->select('products.name as nama_produk','products.image','users.name','keranjang.*','products.price','products.diskon', 'product_attributes.harga', 'product_attributes.size')
                            ->where('keranjang.user_id','=',$id_user)
                            ->get();
        $data = [
            'keranjangs' => $keranjangs,
        ];
        return view('user.keranjang',$data);
    }

    public function simpan(Request $request)
    {
        Keranjang::create([
            'user_id' => $request->user_id,
            'products_id' => $request->products_id,
            'product_attributes_id' => $request->product_attributes_id,
            'durasi' => $request->durasi,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'qty' => $request->qty,
        ]);

        return redirect()->route('user.keranjang');
    }

    function show_Names($n, $m)
    {
    return("The name is $n and email is $m, thank you");
    }

    public function update(Request $request)
    {
        $index = 0;
        foreach($request->id as $id){
            $keranjang = Keranjang::findOrFail($id);
            $keranjang->qty = $request->qty[$index];
            $keranjang->save();
            $index++;
        }
        
        return redirect()->route('user.keranjang');
    }

    public function delete($id)
    {

        Keranjang::destroy($id);
        
        return redirect()->route('user.keranjang');
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Detailorder;
use App\Rekening;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        //menampilkan semua data pesanan
        $user_id = \Auth::user()->id;

        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','status_order.name')
                    ->where('order.status_order_id','!=',2)
                    ->where('order.status_order_id','!=',3)
                    ->where('order.status_order_id','!=',4)
                    ->where('order.status_order_id','!=',5)
                    ->where('order.status_order_id','!=',6)
                    ->where('order.status_order_id','!=',7)
                    ->where('order.status_order_id','!=',9)
                    ->Where('order.status_order_id','!=',10)
                    ->where('order.user_id',$user_id)->get();
        $dicek = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','status_order.name')
                    ->where('order.status_order_id','!=',1)
                    ->Where('order.status_order_id','!=',6)
                    ->Where('order.status_order_id','!=',7)
                    ->Where('order.status_order_id','!=',8)
                    ->Where('order.status_order_id','!=',9)
                    ->Where('order.status_order_id','!=',10)
                    ->where('order.user_id',$user_id)->get();

        $kembali = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->select('order.*','status_order.name','detail_order.denda')
                    ->where('order.status_order_id','!=',1)
                    ->where('order.status_order_id','!=',3)
                    ->where('order.status_order_id','!=',2)
                    ->where('order.status_order_id','!=',4)
                    ->where('order.status_order_id','!=',5)
                    ->Where('order.status_order_id','!=',6)
                    ->Where('order.status_order_id','!=',7)
                    ->Where('order.status_order_id','!=',8)
                    ->where('order.user_id',$user_id)->get();
        $histori = DB::table('order')
        ->join('status_order','status_order.id','=','order.status_order_id')
        ->select('order.*','status_order.name')
        ->where('order.status_order_id','!=',1)
        ->Where('order.status_order_id','!=',2)
        ->Where('order.status_order_id','!=',3)
        ->Where('order.status_order_id','!=',4)
        ->Where('order.status_order_id','!=',5)
        ->Where('order.status_order_id','!=',8)
        ->where('order.status_order_id','!=',9)
        ->Where('order.status_order_id','!=',10)
        ->where('order.user_id',$user_id)->get();
        $data = array(
            'order' => $order,
            'dicek' => $dicek,
            'histori'=> $histori,
            'kembali' => $kembali,
        );
        return view('user.order.order',$data);
    }

    public function detail($id)
    {
        //function menampilkan detail order
        $detail_order = DB::table('detail_order')
        ->join('products','products.id','=','detail_order.product_id')
        ->join('order','order.id','=','detail_order.order_id')
        ->join('product_attributes', 'product_attributes.id', '=', 'detail_order.product_attributes_id')
        ->select('products.name as nama_produk','products.image','detail_order.*','products.price','order.*', 'product_attributes.harga', 'product_attributes.size')
        ->where('detail_order.order_id',$id)
        ->get();
        $order = DB::table('order')
        ->join('users','users.id','=','order.user_id')
        ->join('status_order','status_order.id','=','order.status_order_id')
        ->select('order.*','users.name as nama_pelanggan','status_order.name as status')
        ->where('order.id',$id)
        ->first();
        $data = array(
        'detail' => $detail_order,
        'order'  => $order,
        );
        return view('user.order.detail',$data);
    }

    public function sukses()
    {
        //menampilkan view terimakasih jika order berhasil dibuat
        return view('user.terimakasih');
    }

    public function kirimbukti($id,Request $request)
    {
        //mengupload bukti pembayaran
        $order = Order::findOrFail($id);
        if($request->file('bukti_pembayaran')){
            $file = $request->file('bukti_pembayaran')->store('buktibayar','public');

            $order->bukti_pembayaran = $file;
            $order->status_order_id  = 2;

            $order->save();

        }
        return redirect()->route('user.order');
    }
    
    public function buktiDenda($id,Request $request)
    {
        //mengupload bukti pembayaran
        $detail_order = Detailorder::where('order_id', $id)->firstOrFail();
        if($request->file('bukti_pembayaran')){
            $file = $request->file('bukti_pembayaran')->store('buktibayar','public');

            $detail_order->bukti_pembayaran = $file;
            $detail_order->save();

            $order = Order::findOrFail($id);
            $order->status_order_id  = 2;
            $order->save();


        }
        return redirect()->route('user.order');
    }
    
    public function pembayaran($id)
    {
        $detail_order = DB::table('detail_order')
        ->join('products','products.id','=','detail_order.product_id')
        ->join('order','order.id','=','detail_order.order_id')
        ->select('products.name as nama_produk','products.image','detail_order.*','products.price')
        ->where('detail_order.order_id',$id)
        ->first();
        //menampilkan view pembayaran
        $data = array(
            'rekening' => Rekening::all(),
            'detail_order' => $detail_order,
            'order' => Order::findOrFail($id),
        );
        return view('user.order.pembayaran',$data);
    }

    public function pesanandibatalkan($id)
    {
        //function untuk membatalkan pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 6;
        $order->save();

        return redirect()->route('user.order');

    }

    public function simpan(Request $request)
    {
        //untuk menyimpan pesanan ke table order
        $cek_invoice = DB::table('order')->where('invoice',$request->invoice)->count();
        if($cek_invoice < 1){
            $userid = \Auth::user()->id;
            //jika memilih transfer maka data yang ini
            Order::create([
                'invoice' => $request->invoice,
                'user_id' => $userid,
                'subtotal'=> $request->subtotal,
                'status_order_id' => 1,
                'status_denda' => 0,
                'metode_pembayaran' => $request->metode_pembayaran,
                'pesan' => $request->pesan,
            ]);
        

        $order = DB::table('order')->where('invoice',$request->invoice)->first();
        
        $barang = DB::table('keranjang')->where('user_id',$userid)->get();
        //lalu masukan barang2 yang dibeli ke table detail order
        foreach($barang as $brg){
            Detailorder::create([
                'order_id' => $order->id,
                'product_id' => $brg->products_id,
                'product_attributes_id' => $brg->product_attributes_id,
                'durasi' => $brg->durasi,
                'tgl_mulai' => $brg->tgl_mulai,
                'tgl_selesai' => $brg->tgl_selesai,
                'qty' => $brg->qty,
            ]);
        }
        //lalu hapus data produk pada keranjang pembeli
        DB::table('keranjang')->where('user_id',$userid)->delete();
        return redirect()->route('user.order.sukses');
        }else{
            return redirect()->route('user.keranjang');
        }
        // dd($request);
    
    }
}

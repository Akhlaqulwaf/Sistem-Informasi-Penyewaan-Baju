<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Order;
use App\Detailorder;
use PDF;

class TransaksiController extends Controller
{
    public function index()
    {
        //ambil data order yang status nya 1 atau masih baru/belum melalukan pembayaran
        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan')
                    ->where('order.status_order_id',1)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.index',$data);
    }

    public function detail($id)
    {
        //ambil data detail order sesuai id
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
                    ->select('order.*','users.name as nama_pelanggan','status_order.name as status','users.alamat','users.nomor_hp','users.jaminan')
                    ->where('order.id',$id)
                    ->first();
        $data = array(
            'detail' => $detail_order,
            'order'  => $order
        );
        return view('admin.transaksi.detail',$data);
    }

    public function detailDenda($id)
    {
        //ambil data detail order sesuai id
        $detail_order = DB::table('detail_order')
                            ->join('products','products.id','=','detail_order.product_id')
                            ->join('order','order.id','=','detail_order.order_id')
                            ->join('product_attributes', 'product_attributes.id', '=', 'detail_order.product_attributes_id')
                            ->select('products.name as nama_produk','products.image','detail_order.*','products.price','order.*', 'product_attributes.harga')
                            ->where('detail_order.order_id',$id)
                            ->get();
        $order = DB::table('order')
                    ->join('users','users.id','=','order.user_id')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','users.name as nama_pelanggan','status_order.name as status','users.alamat','users.nomor_hp','users.jaminan', 'detail_order.denda')
                    ->where('order.id',$id)
                    ->first();
        $data = array(
            'detail' => $detail_order,
            'order' => $order
        );
        return view('admin.transaksi.detail_denda',$data);
    }

    public function perludicek()
    {
        //ambil data order yang status nya 2 atau belum di cek / sudah bayar
        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan')
                    ->where('order.status_order_id','!=',1)
                    ->where('order.status_order_id','!=',4)
                    ->where('order.status_order_id','!=',5)
                    ->where('order.status_order_id','!=',6)
                    ->where('order.status_order_id','!=',7)
                    ->where('order.status_order_id','!=',8)
                    ->where('order.status_order_id','!=',9)
                    ->where('order.status_order_id','!=',10)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.perludicek',$data);
    }

    public function dipinjam()
    {
        //ambil data order yang status nya 2 atau belum di cek / sudah bayar
        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan')
                    ->where('order.status_order_id',9)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.dipinjam',$data);
    }

    public function selesai()
    {
        //ambil data order yang status nya 5 barang sudah diterima pelangan
        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan', 'detail_order.denda')
                    ->where('order.status_order_id',7)
                    ->orderByRaw('order.created_at DESC')
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.selesai',$data);
    }

    public function dibatalkan()
    {
        //ambil data order yang status nya 6 dibatalkan pelanngan
        $order = DB::table('order')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan')
                    ->where('order.status_order_id',6)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.dibatalkan',$data);
    }

    public function konfirmasi($id)
    {
        //function ini untuk mengkonfirmasi bahwa pelanngan sudah melakukan pembayaran
        $order = Order::findOrFail($id);
        $order->status_order_id = 3;
        $order->save();

        $kurangistok = DB::table('detail_order')->where('order_id',$id)->get();
        foreach($kurangistok as $kurang){
            $ambilproduk = DB::table('products')->where('id',$kurang->product_id)->first();
            $kat = $ambilproduk->categories_id;

            if($kat != 1){
                $ubahstok = $ambilproduk->stok - $kurang->qty;
                DB::table('products')
                        ->where('id',$kurang->product_id)
                        ->update([
                            'stok' => $ubahstok
                        ]);
            }
            if($kat == 1){
                $attr = DB::table('product_attributes')
                ->where('product_attributes.product_id','=',$kurang->product_id)
                ->where('product_attributes.id','=',$kurang->product_attributes_id)
                ->first();
                $ubahstok = $attr->stok - $kurang->qty;
                DB::table('product_attributes')
                        ->where('id',$kurang->product_attributes_id)
                        ->update([
                            'stok' => $ubahstok
                        ]);
            }
        }
        return redirect()->route('admin.transaksi.perludicek')->with('status','Berhasil Mengonfirmasi Pembayaran Pesanan');
    }

    public function tolakpembayaran($id)
    {
        $order = Order::findOrFail($id);
        Storage::delete('public/'.$order->bukti_pembayaran);
        //function untuk menerima pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 8;
        $order->bukti_pembayaran = '';
        $order->save();

        return redirect()->route('admin.transaksi.perludicek')->with('status','Pesanan ditolak');
    }

    public function pesananditerima($id)
    {
        //function untuk menerima pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 9;
        $order->save();

        return redirect()->route('admin.transaksi.dipinjam')->with('status','Berhasil Masukan Daftar Pinjam');

    }

    public function dendaterbayar($id)
    {
        //function untuk menerima pesanan
        $order = Order::findOrFail($id);
        $order->status_order_id = 7;
        $order->save();

        return redirect()->route('admin.transaksi.selesai')->with('status','Denda terbayar');

    }

    public function kembali($id)
    {
        //function untuk menerima pesanan
        $detil_order = Detailorder::where('order_id', $id)->firstOrFail();
        $detil_order->tgl_kembali = date('Y-m-d', strtotime(Carbon::today()->toDateString()));
        $detil_order->save();
        $tgl1 = new Carbon($detil_order->tgl_selesai);
        $tgl2 = new Carbon($detil_order->tgl_kembali);
        $jarak = $tgl2->diff($tgl1);
        $hasil = $jarak->format("%R");
        $hari = $jarak->format("%a");
        if($hasil == "-"){
            //function untuk menerima pesanan
            $detil_order->denda = 10000*$hari;
            $detil_order->save();
            $order = Order::findOrFail($id);
            $order->status_order_id = 10;
            $order->status_denda = 1;
            $order->save();
            
        return redirect()->route('admin.transaksi.dipinjam')->with('status',"Produk dikembalikan dengan keterlambatan $hari hari");
        }
        else{
            //function untuk menerima pesanan
            $order = Order::findOrFail($id);
            $order->status_order_id = 7;
            $order->save();
            
            return redirect()->route('admin.transaksi.selesai')->with('status','Transaksi sukses');

        }

    }

    public function denda()
    {
        //ambil data order yang status nya 6 dibatalkan pelanngan
        $order = DB::table('order')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->join('users','users.id','=','order.user_id')
                    ->select('order.*','status_order.name','users.name as nama_pemesan','detail_order.denda')
                    ->where('order.status_order_id',10)
                    ->get();
        $data = array(
            'orderbaru' => $order
        );

        return view('admin.transaksi.denda',$data);
    }

    
	public function nota($id){
    	
        //ambil data detail order sesuai id
        $detail_order = DB::table('detail_order')
                            ->join('products','products.id','=','detail_order.product_id')
                            ->join('order','order.id','=','detail_order.order_id')
                            ->join('product_attributes', 'product_attributes.id', '=', 'detail_order.product_attributes_id')
                            ->select('products.name as nama_produk','products.image','detail_order.*','products.price','order.*', 'product_attributes.harga')
                            ->where('detail_order.order_id',$id)
                            ->get();
        $order = DB::table('order')
                    ->join('users','users.id','=','order.user_id')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','users.name as nama_pelanggan','status_order.name as status','users.alamat','users.nomor_hp','users.jaminan','detail_order.denda')
                    ->where('order.id',$id)
                    ->first();

		$pdf = PDF::loadView('admin.transaksi.nota',[
            'detail_order' => $detail_order,
            'order'  => $order
		],compact('detail_order','order'));
        $pdf->setPaper('A4', 'potrait');
		return $pdf->download("nota $order->nama_pelanggan.pdf");
    }

    public function laptgl(Request $request){
        if ($request->tgl_mulai || request()->tgl_selesai){
            $tgl_mulai = Carbon::parse(request()->tgl_mulai);
            $tgl_selesai = Carbon::parse(request()->tgl_selesai);

            $detail_order = DB::table('detail_order')
                    ->join('products','products.id','=','detail_order.product_id')
                    ->join('order','order.id','=','detail_order.order_id')
                    ->join('product_attributes', 'product_attributes.id', '=', 'detail_order.product_attributes_id')
                    ->select('products.name as nama_produk','products.image','detail_order.*','products.price','order.*', 'product_attributes.harga')
                    ->where('detail_order.order_id')
                    ->first();
            $order = DB::table('order')
                    ->join('users','users.id','=','order.user_id')
                    ->join('detail_order','detail_order.order_id','=','order.id')
                    ->join('status_order','status_order.id','=','order.status_order_id')
                    ->select('order.*','users.name as nama_pelanggan','status_order.name as status','users.alamat','users.nomor_hp','users.jaminan','detail_order.denda')
                    ->where('order.id')
                    ->get();

            $printorder = order::join('detail_order','detail_order.order_id','order.id')
            ->join('users','users.id','=','order.user_id')
            ->join('status_order','status_order.id','=','order.status_order_id')
            ->select('order.*', 'users.name as nama_pelanggan', 'status_order.name as status', 'detail_order.tgl_mulai', 'detail_order.tgl_selesai', 'detail_order.denda')
            ->where('tgl_mulai', '>=', $tgl_mulai)->where('tgl_selesai', '<=', $tgl_selesai)->get();
                            //->whereBetween('tgl_mulai',$tgl_mulai,'tgl_selesai',$tgl_selesai)->get();
            
            //(['{{$order->detail_order->tgl_mulai}}',$tgl_mulai],['{{$order->detail_order->tgl_selesai}}',$tgl_selesai])
            $pdf = PDF::loadView('admin.transaksi.laptgl',[
                'detail' => $detail_order,
                'order' => $order,
                'printorder' => $printorder
            ],compact('printorder'));
            $pdf->setPaper('A4', 'potrait');

		    return $pdf->download("nota.pdf");
        }
    }

}

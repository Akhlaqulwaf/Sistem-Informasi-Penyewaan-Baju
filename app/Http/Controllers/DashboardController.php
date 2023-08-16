<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use App\DetailOrder;

class DashboardController extends Controller
{
    public function index()
    {
        //ambil data data untuk ditampilkan di card pada dashboard
        $pendapatan = DB::table('order')
                        ->select(DB::raw('SUM(subtotal) as penghasilan'))
                        ->where('status_order_id',7)
                        ->first();
        $transaksi = DB::table('order')
                        ->select(DB::raw('COUNT(id) as total_order'))
                        ->first();
        $pelanggan = DB::table('users')
                        ->select(DB::raw('COUNT(id) as total_user'))
                        ->where('role','=','customer')
                        ->first();
        $order_terbaru = $order = DB::table('order')
                        ->join('status_order','status_order.id','=','order.status_order_id')
                        ->join('users','users.id','=','order.user_id')
                        ->select('order.*','status_order.name','users.name as nama_pemesan')
                        ->limit(10)
                        ->get();

        $data = array(
            'pendapatan' => $pendapatan,
            'transaksi'  => $transaksi,
            'pelanggan'  => $pelanggan,
            'order_baru' => $order_terbaru
        );

        /**$subtotal = Order::select(DB::raw("CAST(SUM(subtotal) as int) as subtotal"))
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('subtotal');
        /**$month = Order::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->pluck('bulan'); */

        $datap = DB::table('detail_order')
        ->select(DB::raw('products.name as nama'))
        ->join('order','detail_order.order_id','order.id')
        ->join('products','detail_order.product_id','products.id')
        ->where('order.status_order_id',7)
        ->whereYear('detail_order.created_at',date('Y'))
        ->groupBy(DB::raw('month(detail_order.created_at)'))
        ->pluck('nama');

       $batik_solo = DB::table('detail_order')
       ->select(DB::raw('COUNT(detail_order.id) as total_sold'))
       ->join('order','detail_order.order_id','order.id')
       ->join('products','detail_order.product_id','products.id')
       ->where('order.status_order_id', 7)
       ->whereYear('detail_order.created_at',date('Y'))
       ->groupBy(DB::raw('month(detail_order.created_at)'))
       ->pluck('total_sold');

        $bulan = Detailorder::select(DB::raw('month(detail_order.created_at) as month'))
        ->whereYear('detail_order.created_at',date('Y'))
        ->groupBy(DB::raw('month(detail_order.created_at)'))
        ->pluck('month');

        $datasnama = array(
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0),
        array("Tidak ada produk dipinjam",0)
        );
        
        foreach($bulan as $index => $month) {
            $datasnama[$month - 1][0] = $datap[$index];
            $datasnama[$month - 1][1] = $batik_solo[$index];
        }

        return view('admin/dashboard',$data, compact( 'bulan', 'datasnama','datap','batik_solo'));
    }
}

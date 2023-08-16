@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
    <div class="row">
        <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
    </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h2 class="display-5">Detail Pesanan Anda</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">  
                <div class="card-body">
                <div class="row">
                <div class="col-md-8">
                    <table>
                        <tr>
                            <th>No Invoice</th>
                            <td>:</td>
                            <td>{{ $order->invoice }}</td>
                        </tr>
                        <tr>
                            <th>Status Pesanan</th>
                            <td>:</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>:</td>
                            <td>
                            @if($order->metode_pembayaran == 'trf')
                                Transfer Bank
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Total Pembayaran</th>
                            <td>:</td>
                            <td>Rp. {{ number_format($order->subtotal,2,',','.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 text-right">
                </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th class="product-thumbnail">Gambar</th>
                            <th class="product-name">Nama Produk</th>
                            @foreach($detail as $o)
                            @if($o->product_attributes_id != 1)
                            <th class="product-name">Size</th>
                            @endif
                            @endforeach
                            <th class="product-price">Durasi</th>
                            <th class="product-price">Tgl Mulai</th>
                            <th class="product-price">Tgl Selesai</th>
                            <th class="product-price">Jumlah</th>
                            <th class="product-quantity" width="20%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $o)
                            <tr>
                                <td><img src="{{ asset('storage/'.$o->image) }}" alt="" srcset="" width="50"></td>
                                <td>{{ $o->nama_produk }}</td>
                                @if($o->product_attributes_id != 1)
                                <td>{{ $o->size }}</td>
                                @endif
                                <td>{{ $o->durasi }}</td>
                                <td>{{ $o->tgl_mulai }}</td>
                                <td>{{ $o->tgl_selesai }}</td>
                                <td>{{ $o->qty }}</td>
                                @if($o->product_attributes_id != 1)
                                <td>{{ $o->qty * $o->harga * $o->durasi }} </td>
                                @endif
                                @if($o->product_attributes_id == 1)
                                <td>{{ $o->qty * $o->price * $o->durasi }}</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    
                </div>
                </div>
            </div>
        </div>
    </div>
    

    </div>
</div>
@endsection
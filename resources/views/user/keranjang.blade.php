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
    <div class="row mb-5">
        <form class="col-md-12" method="post" action="{{ route('user.keranjang.update') }}">
        @csrf
            <table class="table table-bordered">
            <thead>
                <tr>
                <th class="product-thumbnail">Gambar</th>
                <th class="product-name">Produk</th>
                <th class="product-price">Durasi</th>
                <th class="product-price">Tgl Mulai</th>
                <th class="product-price">Tgl Selesai</th>
                <th class="product-price">Harga</th>
                <th class="product-quantity">Jumlah</th>
                <th class="product-total">Total</th>
                <th class="product-remove">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                <?php $subtotal=0;$total=0;$bayarA=0;$bayarP=0;$hasilP =array(0);$hasilA =array(0); $totalbayar=0; foreach($keranjangs as $keranjang): ?>
                <td class="product-thumbnail">
                    <img src="{{ asset('storage/'.$keranjang->image) }}" alt="Image" class="img-fluid" width="150">
                </td>
                <td class="product-name">
                    <h2 class="h5 text-black">{{ $keranjang->nama_produk }}</h2>
                </td>
                <td class="product-name">
                    {{ $keranjang->durasi }}
                </td>
                <td class="product-name">
                    {{ $keranjang->tgl_mulai }}
                </td>
                <td class="product-name">
                    {{ $keranjang->tgl_selesai }}
                </td>
                @if($keranjang->product_attributes_id != 1)
                <td>Rp. {{ number_format($keranjang->harga,2,',','.') }} </td>
                @endif
                @if($keranjang->product_attributes_id == 1)
                <td>Rp. {{ number_format($keranjang->price,2,',','.') }} </td>
                @endif
                <td class = "product-name">
                    <input type="hidden" name="id[]" value="{{ $keranjang->id }}">
                    {{ $keranjang->qty }}

                </td>
                <?php
                if($keranjang->product_attributes_id != 1){
                    $total = $keranjang->harga * $keranjang->qty * $keranjang->durasi;
                    $diskonP = $keranjang->diskon / 100 *$total;
                    $bayarP = $total - $diskonP;
                    array_push($hasilP,$bayarP);
                }
                if($keranjang->product_attributes_id == 1){
                    $total = $keranjang->price * $keranjang->qty * $keranjang->durasi;
                    $diskonA = $keranjang->diskon / 100 *$total;
                    $bayarA = $total - $diskonA;
                    array_push($hasilA,$bayarA);
                }                
                $totalbayar = array_sum($hasilP) + array_sum($hasilA);
                ?>
                <td>Rp. {{ number_format($total,2,',','.') }}</td>
                <td><a href="{{ route('user.keranjang.delete',['id' => $keranjang->id]) }}" class="btn btn-primary btn-sm">X</a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
            </table>
        
    </div>

    <div class="row">
        <div class="col-md-6">
        <div class="row mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
            </div>
            </form>       
        </div>
        </div>
        <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
            <div class="col-md-7">
            <div class="row">
                <div class="col-md-12 text-right border-bottom mb-5">
                <h3 class="text-black h4 text-uppercase">Total Belanja</h3>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                <span class="text-black">Potongan</span>
                </div>
                <div class="col-md-6 text-right">
                @foreach($keranjangs as $key)

                @if($key->product_attributes_id != 1)
                <strong class="text-black">Rp. {{ number_format($diskonP,2,',','.') }}</strong>
                @endif

                @if($key->product_attributes_id == 1)
                <strong class="text-black">Rp. {{ number_format($diskonA,2,',','.') }}</strong>
                @endif

                @endforeach
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-6">
                <span class="text-black">Total</span>
                </div>
                <div class="col-md-6 text-right">
                <strong class="text-black">Rp. {{ number_format($totalbayar,2,',','.') }}</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                <a href="{{ route('user.checkout') }}" class="btn btn-primary btn-lg py-3 btn-block" >Checkout</a>
                <small>Jika Merubah Quantity Pada Keranjang Maka Klik Update Keranjang Dulu Sebelum Melakukan Checkout</small>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection
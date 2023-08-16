@extends('user.app')
@section('content')
<div class="site-blocks-cover" style="background-image: url({{ asset('shopper') }}/images/hero_12.jpg);" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">Cari Kebutuhan Pernikahan Kamu Di Sini</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4"> Peminjaman baju & asessoris dari berbagai daerah di nana salon . </p>
                    <p>
                        <a href="{{ route('user.produk') }}" class="btn btn-sm btn-primary">Pinjam Sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-section-sm site-blocks-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                <div class="icon mr-4 align-self-start">
                    <i class='fas fa-angle-left'></i>
                    <span class="icon-truck"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Pengambilan</h2>
                    <p>Pengambilan barang semua transaksi dilakukan ditempat toko.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-star"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Kualitas Oke</h2>
                    <p>Kualitas barangnya terjamin karena semuanya disini original bukan kw.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-security"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Keamanan</h2>
                    <p>Kami menjamin keamanan dalam bertransaksi dengan amanah.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-section block-3 site-blocks-2 bg-light" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Produk Terlaris</h2>
            </div>
        </div>
        <div class="row">
                <?php 
                    use Illuminate\Support\Facades\DB;
                    $no = 0;
                ?>
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    @foreach($produks as $produk)
                    <div class="item">
                        <div class="block-4 text-center">
                            <a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}">
                                <figure class="block-4-image">
                                    <img src="{{ asset('storage/'.$produk->image) }}" alt="Image placeholder" class="img-fluid" width="100%" style="height:300px">
                                </figure>
                            </a>
                            <div class="block-4-text p-4">
                                <h3><a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}">{{ $produk->name }}</a></h3>
                                @if ($produk->categories_id != 1)
                                <p class="mb-0">{{ $produk->price }}</p>
                                @endif

                                <?php 
                                    $products = DB::table('product_attributes')
                                                ->select('product_attributes.harga as harga')
                                                ->where('product_attributes.product_id','=',$produk->id)
                                                ->orderByRaw('harga')
                                                ->pluck('harga');
                                    $length = count($products);
                                ?>
                                @if ($produk->categories_id == 1)
                                <p class="mb-0">RP 
                                @if ($length == 1)    
                                <?php echo $products[0]; ?>
                                @else
                                <?php echo $products[0]; ?> - <?php echo $products[$length-1]; ?>
                                @endif
                                </p>
                                @endif
                                <a href="{{ route('user.produk.detail',['id' =>  $produk->id]) }}" class="btn btn-primary mt-2">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
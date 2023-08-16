@extends('user.app')
@section('content')
<style type="text/css">
        .slider{
        width: 550px;
        height: 600px;
        border-radius: 10px;
        overflow: hidden;
        }

        .slides{
        width: 550%;
        height: 600px;
        display: flex;
        }

        .slides input{
        display: none;
        }

        .slide{
        width: 20%;
        transition: 2s;
        }

        .slide img{
        width: 550px;
        height: 600px;
        }

        /*css for manual slide navigation*/

        .navigation-manual{
        position: absolute;
        width: 550px;
        margin-top: -40px;
        display: flex;
        justify-content: center;
        }

        .manual-btn{
        border: 2px solid #40D3DC;
        padding: 5px;
        border-radius: 10px;
        cursor: pointer;
        transition: 1s;
        }

        .manual-btn:not(:last-child){
        margin-right: 40px;
        }

        .manual-btn:hover{
        background: #40D3DC;
        }

        #radio1:checked ~ .first{
        margin-left: 0;
        }

        #radio2:checked ~ .first{
        margin-left: -20%;
        }

        #radio3:checked ~ .first{
        margin-left: -40%;
        }

        #radio4:checked ~ .first{
        margin-left: -60%;
        }

        /*css for automatic navigation*/

        .navigation-auto{
        position: absolute;
        display: flex;
        width: 550px;
        justify-content: center;
        margin-top: 559px;
        }

        .navigation-auto div{
        border: 2px solid #40D3DC;
        padding: 5px;
        border-radius: 10px;
        transition: 1s;
        }

        .navigation-auto div:not(:last-child){
        margin-right: 40px;
        }

        #radio1:checked ~ .navigation-auto .auto-btn1{
        background: #40D3DC;
        }

        #radio2:checked ~ .navigation-auto .auto-btn2{
        background: #40D3DC;
        }

        #radio3:checked ~ .navigation-auto .auto-btn3{
        background: #40D3DC;
        }

        #radio4:checked ~ .navigation-auto .auto-btn4{
        background: #40D3DC;
        }
</style>
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="{{ route('user.produk') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">{{ $produk->name }}</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <div class="slider">
                <div class="slides">
                    <!--radio buttons start-->
                    <input type="radio" name="radio-btn" id="radio1">
                    @if($produk->image1 != null)
                    <input type="radio" name="radio-btn" id="radio2">
                    @endif
                    @if($produk->image2 != null)
                    <input type="radio" name="radio-btn" id="radio3">
                    @endif
                    @if($produk->image3 != null)
                    <input type="radio" name="radio-btn" id="radio4">
                    @endif
                    <!--radio buttons end-->
                    <!--slide images start-->
                    <div class="slide first">
                    <img src="{{ asset('storage/' . $produk->image) }}" alt="">
                    </div>
                    @if($produk->image1 != null)
                    <div class="slide">
                    <img src="{{ asset('storage/' . $produk->image1) }}" alt="">
                    </div>
                    @endif
                    @if($produk->image2 != null)
                    <div class="slide">
                    <img src="{{ asset('storage/' . $produk->image2) }}" alt="">
                    </div>
                    @endif
                    @if($produk->image3 != null)
                    <div class="slide">
                    <img src="{{ asset('storage/' . $produk->image3) }}" alt="">
                    </div>
                    @endif
                    <!--slide images end-->
                    <!--automatic navigation start-->
                    <div class="navigation-auto">
                    <div class="auto-btn1"></div>
                    @if($produk->image1 != null)
                    <div class="auto-btn2"></div>
                    @endif
                    @if($produk->image2 != null)
                    <div class="auto-btn3"></div>
                    @endif
                    @if($produk->image3 != null)
                    <div class="auto-btn4"></div>
                    @endif
                    </div>
                    <!--automatic navigation end-->
                </div>
                <!--manual navigation start-->
                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    @if($produk->image1 != null)
                    <label for="radio2" class="manual-btn"></label>
                    @endif
                    @if($produk->image2 != null)
                    <label for="radio3" class="manual-btn"></label>
                    @endif
                    @if($produk->image3 != null)
                    <label for="radio4" class="manual-btn"></label>
                    @endif
                </div>
                <!--manual navigation end-->
                </div>
                <!--image slider end-->
			    <!-- <img id=featured src="{{ asset('storage/' . $produk->image) }}">

                <div id="slide-wrapper" >
                    <img id="slideLeft" class="arrow" src="{{ asset('shopper') }}/images/arrow-left.png">

                    <div id="slider">
                        <img class="thumbnail active" src="{{ asset('storage/' . $produk->image) }}">
                        @if($produk->image1 != null)
                        <img class="thumbnail" src="{{ asset('storage/' . $produk->image1) }}">
                        @endif
                        @if($produk->image2 != null)
                        <img class="thumbnail" src="{{ asset('storage/' . $produk->image2) }}">
                        @endif
                        @if($produk->image3 != null)
                        <img class="thumbnail" src="{{ asset('storage/' . $produk->image3) }}">
                        @endif
                    </div>

                    <img id="slideRight" class="arrow" src="{{ asset('shopper') }}/images/arrow-right.png">
			    </div> -->

            </div>
            <div class="col-md-6">
                <h2 class="text-black">{{ $produk->name }}</h2>
                <p>
                    {{ $produk->description }}
                </p>
                @if($produk->categories_id != 1)
                <p><strong class="text-primary h4" id="produk_price">Rp {{ $produk->price }} </strong></p>
                @endif
                @if($produk->categories_id ==1)
                <p><strong class="text-primary h4" id="produk_price">Rp 
                    
                <?php $no = 0; ?>
                                @foreach($produkAttri as $produkAttri) <?php $no++ ?> {{ $produkAttri->harga }} <?php if ($no != $length){ echo "- Rp"; }?> @endforeach</strong></p>
                @endif
                <div class="mb-5">
                    <form id="toCart" action="{{ route('user.keranjang.simpan') }}" method="post">
                        @csrf
                        @if(Route::has('login'))
                        @auth
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @endauth
                        @endif

                        @if($produk->categories_id==3)
                        <input type="hidden" name="product_attributes_id" value="1">
                        @endif
                        @if($produk->categories_id==1)
                        <div class="form-group" id="form1">
                            <label for="exampleInputUsername1">Size</label>
                            <select class="form-control" name="product_attributes_id" id="product_attributes_id" onchange="Fungsiku()">
                                <option value="">Pilih Size</option>
                                @foreach($produkDetails as $produkDetail)
                                <option value="{{$produkDetail->id}}">{{ $produkDetail->size }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputUsername1">Tanggal Mulai</label>
                            <input required type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" onchange="myFunction()" placeholder="Tanggal Mulai">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Tanggal Selesai</label>
                            <input required type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" onchange="selisih()" placeholder="Tanggal Selesai">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">Durasi Per-Hari</label>
                            <input required type="number" class="form-control" id="durasi" name="durasi" placeholder="Hari" readonly>
                        </div>
                        @if($produk->categories_id==1)
                        <input type="hidden" name="products_id" value="">
                                <small>Sisa Stok</small>
                            @foreach($produkDetails as $produkDetail)
                                <p>{{ $produkDetail->size }} - {{ $produkDetail->stok }}</p>
                            @endforeach
                        @endif
                        
                        <input type="hidden" name="products_id" value="{{ $produk->id }}">

                        @if($produk->categories_id==3)
                        <small>Sisa Stok {{ $produk->stok }}</small>
                        @endif
                        <input type="hidden" value="{{ $produk->stok }}" id="sisastok">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" id="qty" name="qty" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>

                </div>
                @if($produk->categories_id==1)
                <p><button id="smt" class="buy-now btn btn-sm btn-primary">Add To Cart</button></p>
                @endif
                @if($produk->categories_id==3)
                <p><button id="smt" class="buy-now btn btn-sm btn-primary" onclick="toCart()">Add To Cart</button></p>
                @endif
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    $a = array();
    $b = array();
    foreach ($detailOrder as $detailOrder) {
        array_push($a, $detailOrder->tgl_mulai);
        array_push($b, $detailOrder->tgl_selesai);
    }
?>
<?php 
    use Illuminate\Support\Facades\DB;
    // $products = DB::table('product_attributes')
    //             ->where('product_attributes.product_id','=',$id)
    //             ->get();
?>


<script type="text/javascript">
        


function toCart() {
    var kat = <?php echo "$produk->categories_id"; ?>;
    var qty = document.getElementById("qty").value;
    if(kat != 1){
        var stok = <?php echo "$produk->stok"; ?>;
        if(qty>stok){
        event.preventDefault();
        alert("Pemesanan melebihi batas");
        }
    }
}
function Fungsiku() {
}
function selisih() {
    var date1 = document.getElementById("tgl_mulai").value;
    var date2 = document.getElementById("tgl_selesai").value;
    date1 = new Date(date1);
    date2 = new Date(date2);
    var ajg = date2 - date1;
    var asd = ajg/86400000;
    var aaa = asd.toFixed(0);
    document.getElementById("durasi").value = aaa;
}
function myFunction() {
    var x = document.getElementById("tgl_mulai").value;
    var a = <?php echo json_encode($a); ?>;
    var kembali = <?php echo json_encode($b); ?>;
    var b = [x];
    const filteredArray = a.filter(value => b.includes(value));
    const filteredKembali = kembali.filter(value => b.includes(value));

    for(var i=0; i<filteredArray.length; i++){
        if(filteredArray.length>0){
        alert("Sudah dipinjam pada tanggal "+filteredArray[0]);
        document.getElementById('tgl_mulai').value = '';
        }
    }

    for(var i=0; i<filteredKembali.length; i++){
        if(filteredKembali.length>0){
        alert("Sudah dipinjam pada tanggal "+filteredKembali[0]);
        document.getElementById('tgl_mulai').value = '';
        }
    }
  
}


        
</script>

@endsection
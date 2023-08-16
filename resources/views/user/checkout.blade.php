@extends('user.app')
@section('content')
<div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <form action="{{ route('user.order.simpan') }}" method="POST">
                    @csrf
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php $subtotal=0;$total=0;$bayarA=0;$bayarP=0;$hasilP =array(0);$hasilA =array(0);?>
                      @foreach($keranjangs as $keranjang)
                      <tr>
                        <td>{{ $keranjang->nama_produk }} <strong class="mx-2">x</strong> {{ $keranjang->qty }}</td>
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
                      </tr>
                      <tr>
                        <td>Durasi Per-Hari</td>
                        <td>{{ $keranjang->durasi}} Hari</td>
                      </tr>
                      <tr>
                        <td>Tanggal Mulai</td>
                        <td>{{ $keranjang->tgl_mulai}}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Selesai</td>
                        <td>{{ $keranjang->tgl_selesai}}</td>
                      </tr>
                      @endforeach
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Jumlah Pembayaran</strong></td>
                        <td class="text-black font-weight-bold">
                        <?php $alltotal = $totalbayar ?>  
                        <strong>Rp. {{ number_format($alltotal,2,',','.') }}</strong></td>
                      </tr>
                      <tr>
                      <td>Alamat Toko</td>
                      <td>{{ $alamat_toko->detail }}, {{ $alamat_toko->kota }}, {{ $alamat_toko->prov }}</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="form-group">
                    <label for="">Catatan</label>
                    <textarea name="pesan" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                      <label>Jaminan (*Foto KTP/KK)</label>
                      <p> <img src="{{ asset('storage/'.$users->jaminan) }}" alt="" style="width: 70px;"> </p>
                  </div>
                  <div class="form-group">
                    <label for="">No telepon yang bisa dihubungi</label>
                    <input type="number" name="user_id" id="" class="form-control" value="{{ $users->nomor_hp }}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="user_id">Alamat</label>
                    <textarea name="user_id" class="form-control" value="{{ $users->alamat }}" readonly> {{$users->alamat}}</textarea>
                  </div>
                  <input type="hidden" name="invoice" value="{{ $invoice }}">
                  <input type="hidden" name="subtotal" value="{{ $alltotal }}">
                  <div class="form-group">
                    <label for="">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" id="" class="form-control" value="trf" readonly>
                  </div>
                 <small>Semua Transaksi Pengambilan Di Alamat Toko Diatas</small>
                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" type="submit">Pesan Sekarang</button>
                  </div>
                </form>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
@endsection
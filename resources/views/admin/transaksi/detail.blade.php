@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Pesanan
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
      </ul>
    </nav>
  </div>
  <div class="row">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row mb-3">
            <div class="col">
              <h4 class="card-title">Detail Pesanan {{ $order->nama_pelanggan }}</h4>
            </div>
            <div class="col text-right">
              <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-7">
              <table>
                <tr>
                  <td>No Invoice</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->invoice }}</td>
                </tr>
                <tr>
                  <td>Metode Pembayaran</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->metode_pembayaran }}</td>
                </tr>
                <tr>
                  <td>Status Pesanan</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->status }}</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>:</td>
                  <td class="p-2">Rp. {{ number_format($order->subtotal,2,',','.') }}</td>
                </tr>
                <tr>
                  <td>No Hp</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->nomor_hp }}</td>
                </tr>
                <tr>
                  <td>Catatan Pelanggan</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->pesan }}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>:</td>
                  <td class="p-2">{{ $order->alamat }}</td>
                </tr>
                <tr>
                  <td>Jaminan</td>
                  <td>:</td>
                  <td class="p-2"><img src="{{ asset('storage/'.$order->jaminan) }}" alt="" srcset="" class="img-fluid" width="300"></td>
                </tr>
                @if($order->bukti_pembayaran != null)
                <tr>
                  <td>Bukti Pembayaran</td>
                  <td>:</td>
                  <td class="p-2"><img src="{{ asset('storage/'.$order->bukti_pembayaran) }}" alt="" srcset="" class="img-fluid" width="300"></td>
                </tr>
                @if($order->status_order_id == 2)
                <tr>
                  <td></td>
                  <td class="p-2"><a href="{{ route('admin.transaksi.tolakpembayaran',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin menolak pesanan ini?')" class="btn btn-danger mt-1">Tolak Pembayaran</a><br>
                    <small>Klik tombol ini jika pembeli terbukti mengirimkan bukti tidak sesuai</small>
                  </td>
                  <td class="p-2"><a href="{{ route('admin.transaksi.konfirmasi',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin mengonfirmasi pesanan ini?')" class="btn btn-primary mt-1">Konfirmasi Telah Bayar</a><br>
                    <small>Klik tombol ini jika pembeli sudah terbukti melakukan pembayaran</small>
                  </td>
                </tr>
                @endif

                @endif
                @if($order->status_order_id == 3)
                @if($order->status_denda == 0)
                <tr>
                  <td></td>
                  <td class="p-2">
                    <a href="{{ route('admin.transaksi.pesananditerima',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin melanjutkan ?')" class="btn btn-primary">Masukan Ke Daftar Pinjam </a><br>
                    <small>Masukan ke daftar pinjam</small>
                  </td>
                  @endif
                  @if($order->status_denda == 1)
                <tr>
                  <td></td>
                  <td class="p-2">
                    <a href="{{ route('admin.transaksi.dendaterbayar',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin melanjutkan ?')" class="btn btn-primary">Pembayaran Denda </a><br>
                    <small>Klik tombol ini jika pembeli sudah melakukan pembayaran ditempat</small>
                  </td>
                  @endif
                  @endif

                  @if($order->status_order_id == 9)
                <tr>
                  <td></td>
                  <td class="p-2">
                    <a href="{{ route('admin.transaksi.kembali',['id' => $order->id]) }}" onclick="return confirm('Yakin ingin melanjutkan ?')" class="btn btn-primary">Produk Dikembalikan </a><br>
                    <small>Klik tombol ini jika pembeli sudah melakukan pengembalian ditempat</small>
                  </td>
                  @endif

              </table>
            </div>
            <div class="col-md-5">
              <div class="table-responsive">
                <table class="table table-bordered table-hovered">
                  <thead class="bg-primary text-white">
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Produk</th>
                      @foreach($detail as $dt)
                      @if($dt->product_attributes_id != 1)
                      <th>Size</th>
                      @endif
                      @endforeach
                      <th>Durasi Per-hari</th>
                      <th>Tgl Mulai</th>
                      <th>Tgl Selesai</th>
                      @if($order->status_order_id ==7)
                      <th>Tgl Kembali </th>
                      @endif
                      <th>QTY</th>
                      <th>Total Harga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    @foreach($detail as $dt)
                    <tr>
                      <td>{{ $no++ }}</td>
                      <td>{{ $dt->nama_produk }}</td>
                      @if($dt->product_attributes_id != 1)
                      <td>{{ $dt->size }}</td>
                      @endif
                      <td>{{ $dt->durasi }}</td>
                      <td>{{ $dt->tgl_mulai }}</td>
                      <td>{{ $dt->tgl_selesai }}</td>
                      @if($order->status_order_id ==7)
                      <td>{{$dt->tgl_kembali}}</td>
                      @endif
                      <td>{{ $dt->qty }}</td>
                      @if($dt->product_attributes_id == 1)
                      <td>{{ $dt->qty * $dt->price * $dt->durasi }}</td>
                      @endif

                      @if($dt->product_attributes_id != 1)
                      <td>{{ $dt->qty * $dt->harga * $dt->durasi }} </td>
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
</div>

@endsection
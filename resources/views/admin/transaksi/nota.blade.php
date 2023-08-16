<html>

<head>
    <title> Nota Pembelian </title>
    <style type="text/css">
        .judul {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }

        .teng {
            text-align: center;
        }

        .left {
            text-align: justify;
            text-indent: 0.1in;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <div>
        <div class="judul">NANA SALON</div>
        <div class="judul">BANDAR LOR GG 10</div>
        <br>
        <div class="left">Pelanggan : {{ $order->nama_pelanggan }}</div>
        <br>
        <table style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Produk</th>
                    <th>Durasi </th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    @if($order->status_order_id ==7)
                    <th>Tgl Kembali </th>
                    @endif
                    <th>QTY</th>
                    <th>Total Harga</th>
                    <th>Denda </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($detail_order as $dt)
                <tr>
                    <td class='teng'>{{ $no++ }}</td>
                    <td class='teng'>{{ $dt->nama_produk }}</td>
                    <td class='teng'>{{ $dt->durasi }} Hari</td>
                    <td class='teng'>{{ $dt->tgl_mulai }}</td>
                    <td class='teng'>{{ $dt->tgl_selesai }}</td>
                    @if($order->status_order_id ==7)
                    <td class='teng'>{{$dt->tgl_kembali}}</td>
                    @endif

                    <td class='teng'>{{ $dt->qty }}</td>
                    @if($dt->product_attributes_id == 1)
                    <td class='teng'>{{ $dt->qty * $dt->price * $dt->durasi }}</td>
                    @endif

                    @if($dt->product_attributes_id != 1)
                    <td class='teng'>{{ $dt->qty * $dt->harga * $dt->durasi }} </td>
                    @endif

                    @if($dt->status_denda == 1)
                    <td class='teng'>{{$dt->denda}}</td>
                    @endif

                    @if($dt->status_denda !=1)
                    <td class='teng'> Tidak </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <p> Nomer Invoice  : {{$order->invoice}} </p>
        <p> Status Pesanan : {{$order->status}} </p>
        @if($order->status_denda == 1)
        <p> Total Denda    : {{$order->denda}} </p>
        @endif
    </div>
</body>

</html>
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
        <table style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>No Invoice</th>
                    <th>Pemesan </th>
                    <th>Tgl Mulai </th>
                    <th>Tgl Selesai </th>
                    <th>Subtotal</th>
                    <th>Metodo Pembayaran</th>
                    <th>Status Pesanan</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach($printorder as $dt)
                <tr>
                    <td class="teng">{{ $no++ }}</td>
                    <td class="teng">{{ $dt->invoice }}</td>
                    <td class="teng">{{ $dt->nama_pelanggan }}</td>
                    <td class="teng">{{ $dt->tgl_mulai }}</td>
                    <td class="teng">{{ $dt->tgl_selesai }}</td>
                    <td class="teng">{{ $dt->subtotal }}</td>
                    <td class="teng">{{ $dt->metode_pembayaran }}</td>
                    <td class="teng">{{ $dt->status}}</td>
                    @if($dt->status_denda !=0)
                    <td class="teng">{{ $dt->denda }}</td>
                    @endif
                    @if($dt->status_denda ==0)
                    <td class="teng">Tidak</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
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
            <div class="col-md-12">
                <h2 class="btn btn-warning text-white">Alamat</h2>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th class="product-name">Nama</th>
                                    <th class="product-price">Nomor Hp</th>
                                    <th class="product-price">Alamat</th>
                                    <th class="product-price">Jaminan (*ktp)</th>
                                    <th class="product-quantity" width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td align="center"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->nomor_hp }}</td>
                                    <td>{{ $user->alamat }}</td>
                                    <td><img src="{{ asset('storage/'.$user->jaminan) }}" alt="image" style="width:60px;" ></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('user.alamat.edit',['id'=>$user->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="mdi mdi-tooltip-edit"> Edit</i>
                                            </a>
                                        </div>
                                    </td>
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
@endsection
@section('js')
<script type="text/javascript">
    var toHtml = (tag, value) => {
        $(tag).html(value);
    }
    $(document).ready(function() {
        //  $('#province_id').select2();
        //  $('#cities_id').select2();
        $('#province_id').on('change', function() {
            var id = $('#province_id').val();
            var url = window.location.href + '/getcity/' + id;
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function(data) {
                    var op = '<option value="">Pilih Kota</option>';
                    if (data.length > 0) {
                        var i = 0;
                        for (i = 0; i < data.length; i++) {
                            op += `<option value="${data[i].city_id}">${data[i].title}</option>`
                        }
                    }
                    toHtml('[name="cities_id"]', op);
                }
            })
        })
    });
</script>
@endsection
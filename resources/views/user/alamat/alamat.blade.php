@extends('user.app')
@section('content')
<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Alamat
        </h3>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h4 class="card-title">Alamat</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('user.alamat.simpan') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Nama</label>
                                    <input required type="text" class="form-control" name="user_id" >
                                </div>
                                <div class="form-group">
                                    <label for="detail">Detail Alamat</label>
                                    <textarea name="detail" id="" cols="30" rows="10" class="form-control" required>
                                </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jaminan">Jaminan *ktp</label>
                                    <input required type="file" class="form-control" name="jaminan">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Simpan</button>
                                </div>
                            </form>
                        </div>
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
            var url = window.location.href;
            var urlNya = url.substring(0, url.lastIndexOf('/alamat/'));
            $.ajax({
                type: 'GET',
                url: urlNya + '/getcity/' + id,
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
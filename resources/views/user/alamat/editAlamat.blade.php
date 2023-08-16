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
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('user.alamat.update',['id' => $users->id]) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="exampleInputUsername1">Nama</label>
                <input required type="text" class="form-control" name="name" value="{{ $users->name }}">
              </div>
              <div class="form-group">
                <label for="alamat">Nomor Hp</label>
                <input required type="text" class="form-control" name="nomor_hp" value="{{ $users->nomor_hp }}">
              </div>
              <div class="form-group">
                <label for="alamat">Detail Alamat</label>
                <input required type="text" class="form-control" name="alamat" value="{{ $users->alamat }}">
              </div>
              <div class="form-group">
                <label>Jaminan *ktp</label>
                <input type="file" name="jaminan" class="form-control">
                <small>kosongkan jika tidak mengubah gambar</small>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-success text-right">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
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
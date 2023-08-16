@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Tambah Produk </h3>
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
                      <h4 class="card-title">Tambah Produk</h4>
                      </div>
                      <div class="col text-right">
                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                <label for="exampleInputUsername1">Produk Kode</label>
                                <input required type="text" class="form-control" name="product_code">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputUsername1">Nama Produk</label>
                                <input required type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Pilih Kategori</label>
                                    <select class="form-control" name="categories_id" id="exampleFormControlSelect2" onchange="Fungsiku()">
                                        <option value="">Pilih kategori</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="price">
                                <label for="exampleInputUsername1">Harga</label>
                                <input  type="number" class="form-control" name="price">
                                </div>
                                <div class="form-group" id="stok">
                                <label for="exampleInputUsername1">Stok</label>
                                <input  type="number" class="form-control" name="stok">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input  type="file" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input  type="file" name="image1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input  type="file" name="image2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input  type="file" name="image3" class="form-control">
                                </div>
                                <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" required>
                                </textarea>
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
          
<script>
function Fungsiku() {
    var kategori = document.getElementById("exampleFormControlSelect2").value;
    let stok = document.getElementById("stok");
    let harga = document.getElementById("price");
    if(kategori == 1){
      stok.hidden = true;
      harga.hidden = true;
    }
    if(kategori != 1){
      stok.hidden = false;
      harga.hidden = false;
    }
}
</script>
@endsection

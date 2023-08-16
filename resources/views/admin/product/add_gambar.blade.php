@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Add Attribute </h3>
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
                      <h4 class="card-title">Add Gambar</h4>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.product.addgambar',['id' => $detail_gambar->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $detail_gambar->id }}">
                                
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input required type="file" name="gambar" class="form-control">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success text-right">Add Attributes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-12 grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <div class="row mb-3">
                              <div class="col">
                              <h4 class="card-title">View Attribute</h4>
                              </div>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-bordered table-hovered" id="table">
                                <thead>
                                  <tr>
                                    <th width="5%">No</th>
                                    <th>Gambar</th>
                                    <th width="15%">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($gambar as $detail)
                                    <tr>
                                        <td align="center"></td>
                                        <td><img src="{{ asset('storage/'.$detail->gambar) }}" alt="" ></td>
                                        <td align="center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="{{ route('admin.product.deleteGambar',['id'=>$detail->id]) }}" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
                                            <i class="mdi mdi-delete-forever"></i>
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
                </div>
              </div>
            </div>
          </div>
          
@endsection

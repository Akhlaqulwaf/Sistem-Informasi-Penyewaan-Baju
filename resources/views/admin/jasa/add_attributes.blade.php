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
                      <h4 class="card-title">Add Attributes</h4>
                      </div>
                      <div class="col text-right">
                      <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-primary">Kembali</a>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.jasa.addAttributes',['id' => $jasaDetails->id]) }}" method="POST">
                                @csrf
                                    <input type="hidden" name="jasa_id" value="{{ $jasaDetails->id }}">
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Nama Produk</label>
                                      <label class="form-control">{{$jasaDetails->name}}</label>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputUsername1">Kode Produk</label>
                                      <label class="form-control">{{$jasaDetails->jasa_code}}</label>
                                    </div>
                                    <div class="form-group">
                                      <div class="field_wrapper">
                                          <div>
                                              <input type="text" name="sku[]" id="sku" placeholder="Sku" style="width:150px;"/>
                                              <input type="text" name="price[]" id="price" placeholder="Harga" style="width:150px;"/>
                                              <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                          </div>
                                      </div>
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
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th width="15%">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($jasaDetails['attributes'] as $attribute)
                                    <tr>
                                        <td align="center"></td>
                                        <td>{{ $attribute->sku }}</td>
                                        <td>{{ $attribute->size }}</td>
                                        <td>{{ $attribute->price }}</td>
                                        <td>{{ $attribute->stok }}</td>
                                        <td align="center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="{{ route('admin.jasa.deleteAttribute',['id'=>$attribute->id]) }}" onclick="return confirm('Yakin Hapus data')" class="btn btn-danger btn-sm">
                                            <i class="mdi mdi-delete-forever"></i>
                                          </a>
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

@extends('layout.template')
@section('content')
<div class="page-heading">
    <p class="text-subtitle text-muted">Selamat datang {{Auth::user()->name}}</p>
</div>
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">Semua baju</h4>
    </div>
    <div class="mt-5 col-lg-12 col-md-12 mx-auto">
        <div class="card-body">
            <div class="row">
                @foreach($pilihbaju as $val)
                <div class="card mx-auto col-md-4 col-lg-3 col-sm-6 d-flex justify-content-between shadow-sm">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <img src="/foto_produk/{{$val->foto_dep}}" alt="404" width="100" height="60">
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <img src="/foto_produk/{{$val->foto_bel}}" alt="404" width="100" height="60">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                                <h6>Nama produk</h6>
                            </div>
                            <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                                <p>: {{$val->nama_produk}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                                <h6>Warna</h6>
                            </div>
                            <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                                <p>: {{$val->nama_warna}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                                <h6>Size</h6>
                            </div>
                            <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                                <p>: {{$val->size}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                                <h6>Harga</h6>
                            </div>
                            <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                                <p>: {{$val->harga_jual}}</p>
                            </div>
                        </div>
                        <!-- button modal info -->
                        <div class="mb-2 col-lg-4 col-md-4 col-sm-2 mx-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->produk_id}}">
                                <i class="fas fa-info"></i>
                                Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- modal for info produk baju -->
                <div class="modal modal-xl" id="modalInfo{{$val->produk_id}}" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail baju</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-6 mb-3">
                                        <h6>Nama barang</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$val->nama_produk}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-6 mb-3">
                                        <h6>Warna</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$val->nama_warna}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-6 mb-3">
                                        <h6>Stok</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$val->jumlah}}, {{$val->satuan}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-6 mb-3">
                                        <h6>Harga</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$val->harga_jual}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-sm-6 mb-3">
                                        <h6>Deskripsi</h6>
                                    </div>
                                    <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                                        <p>: {{$val->deskripsi}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- button modal beli baju -->
                            <div class="modal-footer">
                                <div class="mb-2 col-lg-2 col-md-11 col-sm-11 d-flex justify-content-around mx-auto">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalBeli{{$val->produk_id}}">
                                            <i class="fas fa-shopping-bag"></i>
                                            Beli
                                        </button>
                                    </div>
                                    <!-- <div class="col-md-6 col-sm-6 col-lg-6">
                                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalBeli{{$val->produk_id}}">
                                            <i class="fas fa-shopping-cart"></i>
                                            Pesan
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
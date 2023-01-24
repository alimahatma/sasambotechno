@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>All produk</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali </p>
            </div>
        </div>
    </div>
    <section class="section">
        <div>
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <div class="mb-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>

                                <th class="text-center">Nama supplier</th>

                                <th class="text-center">Jenis produk</th>

                                <th class="text-center">Jumlah stok</th>
                                <th class="text-center">warna</th>
                                <th class="text-center">Harga jual</th>

                                <th class="text-center">Nama Produk</th>
                                <th class="text-center">Foto produk</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($produks as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_supplier}}</td>
                                <td>{{$val->jenis_produk}}</td>
                                <td>{{$val->jumlah}}</td>
                                <td>{{$val->warna}}</td>
                                <td>{{$val->harga_jual}}</td>
                                <td>{{$val->nama_produk}}</td>
                                <td><img src="/foto_produk/{{$val->foto_prdk}}" alt="404" width="120" height="60"></td>
                                <td>{{$val->deskripsi}}</td>
                                <td>{{$val->harga}}</td>
                                <td>{{$val->satuan}}</td>
                                <td>{{$val->size}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->produk_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->produk_id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal add-->
<!-- ktgr_id	stok_id	supplier_id	nama_produk	foto_prdk	deskripsi	harga	satuan	size	 -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/produks/addproduk" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Nama produk</h6>
                            <input class="form-control" type="text" name="nama_produk" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto produk</h6>
                            <input class="form-control" type="file" name="foto_prdk" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-2">
                            <h6>Deskripsi produk</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>masukkan deskripsi produk</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga</h6>
                            <input class="form-control" type="number" name="harga" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Satuan</h6>
                            <input class="form-control" type="text" name="satuan" placeholder="masukkan satuan produk" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal update-->
@foreach($produks as $row)
<div class="modal fade" id="modalUpdate{{$row->produk_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/produks/updtproduk" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <input type="hidden" class="form-control" name="produk_id" value="{{$row->produk_id}}">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option value="{{$valId->ktgr_id}}" selected>{{$row->jenis_kategori}}</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Nama produk</h6>
                            <input class="form-control" type="text" name="nama_produk" value="{{$row->nama_produk}}" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto produk</h6>
                            <input class="form-control" type="file" name="foto_prdk" value="{{$row->foto_prdk}}" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-2">
                            <h6>Deskripsi produk</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3">{{$row->deskripsi}}</textarea>
                                    <label>masukkan deskripsi produk</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga</h6>
                            <input class="form-control" type="number" name="harga" value="{{$row->harga}}" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Satuan</h6>
                            <input class="form-control" type="text" name="satuan" value="{{$row->satuan}}" placeholder="masukkan satuan produk" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- modal delete -->
@foreach($produks as $val)
<div class="modal fade" id="modalDelete{{$val->produk_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data ini..?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <a href="/produks/deleteproduk/{{$val->produk_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
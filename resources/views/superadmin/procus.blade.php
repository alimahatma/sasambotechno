@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk baju custom</h3>
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
                        <i class="fas fa-plus"></i>
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama supplier</th>
                                <th class="text-center">Warna</th>
                                <th class="text-center">Nama produk</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Jenis kain</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Harga beli</th>
                                <th class="text-center">Harga jual</th>
                                <th class="text-center">Tanggal masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($procus as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_supplier}}</td>
                                <td>{{$val->nama_warna}}</td>
                                <td>{{$val->nama_produk}}</td>
                                <td>{{$val->satuan}}</td>
                                <td>{{$val->jenis_kain}}</td>
                                <td>{{$val->size}}</td>
                                <td>{{$val->harga_beli}}</td>
                                <td>{{$val->harga_jual}}</td>
                                <td>{{$val->tgl_masuk}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-5 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->procus_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-5 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->procus_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-5 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->procus_id}}">
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
<div class="modal modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/procus/addproduk" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-3">
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
                        <div class="col-6 mt-3">
                            <h6>Supplier</h6>
                            <fieldset class="form-group">
                                <select name="supplier_id" id="basicSelect" class="form-select">
                                    <option selected>pilih supplier</option>
                                    @foreach($supplier as $sup)
                                    <option value="{{$sup->supplier_id}}">{{$sup->nama_supplier}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Kategori produk custom</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_procus_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk custom</option>
                                    @foreach($ktgrProcus as $kpc)
                                    <option value="{{$kpc->ktgr_procus_id}}">
                                        {{$kpc->jenis_procus}}
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Warna</h6>
                            <fieldset class="form-group">
                                <select name="warna_id" id="basicSelect" class="form-select">
                                    <option selected>pilih warna</option>
                                    @foreach($warna as $war)
                                    <option value="{{$war->warna_id}}">
                                        {{$war->nama_warna}},
                                        {{$war->jml_stok}}
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Nama produk</h6>
                            <input class="form-control" type="text" name="nama_produk" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Foto depan</h6>
                            <input class="form-control" type="file" name="foto_dep" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Foto belakang</h6>
                            <input class="form-control" type="file" name="foto_bel" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Satuan produk</h6>
                            <input class="form-control" type="text" name="satuan" placeholder="masukkan satuan produk" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Jenis kain</h6>
                            <input class="form-control" type="text" name="jenis_kain" placeholder="masukkan jenis kain" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Size</h6>
                            <input class="form-control" type="text" name="size" placeholder="masukkan ukuran produk" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Harga beli</h6>
                            <input class="form-control" type="number" name="harga_beli" placeholder="masukkan harga beli" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Harga jual</h6>
                            <input class="form-control" type="number" name="harga_jual" placeholder="masukkan harga jual" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Tanggal masuk</h6>
                            <input class="form-control" type="date" name="tgl_masuk" placeholder="masukkan tanggal masuk" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h6>Deskripsi produk</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>masukkan deskripsi produk</label>
                                </div>
                            </div>
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

<!-- modal info -->
@foreach($procus as $prcs)
<div class="modal modal-lg" id="modalInfo{{$prcs->procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deskripsi {{$prcs->nama_produk}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center"></h5>
                <div class="row g-0 justify-content-around">
                    <div class="col-md-4">
                        <img src="/foto_produk/depan/{{$prcs->foto_dep}}" class="img-fluid rounded-start" alt="404">
                    </div>
                    <div class="col-md-4">
                        <img src="/foto_produk/belakang/{{$prcs->foto_bel}}" class="img-fluid rounded-start" alt="404">
                    </div>
                </div>
                <p class="mt-3 style__font">{{$prcs->deskripsi}}</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal update-->
@foreach($procus as $row)
<div class="modal modal-lg" id="modalUpdate{{$row->procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/procus/updtproduk" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Jenis kategori</h6>
                            <input type="hidden" class="form-control" name="procus_id" value="{{$row->procus_id}}">
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option value="{{$row->ktgr_id}}" selected>{{$row->jenis_kategori}}</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Supplier</h6>
                            <fieldset class="form-group">
                                <select name="supplier_id" id="basicSelect" class="form-select">
                                    <option value="{{$row->supplier_id}}" selected>{{$row->nama_supplier}}</option>
                                    @foreach($supplier as $sup)
                                    <option value="{{$sup->supplier_id}}">{{$sup->nama_supplier}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Kategori produk custom</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_procus_id" id="basicSelect" class="form-select">
                                    <option value="{{$row->ktgr_procus_id}}">{{$row->jenis_procus}}</option>
                                    @foreach($ktgrProcus as $val)
                                    <option value="{{$val->ktgr_procus_id}}">{{$val->jenis_procus}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Warna</h6>
                            <fieldset class="form-group">
                                <select name="warna_id" id="basicSelect" class="form-select">
                                    <option value="{{$row->warna_id}}">{{$row->nama_warna}}, {{$row->jml_stok}}</option>
                                    @foreach($warna as $war)
                                    <option value="{{$war->warna_id}}">
                                        {{$war->nama_warna}},
                                        {{$war->jml_stok}}
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Nama produk</h6>
                            <input class="form-control" type="text" name="nama_produk" value="{{$row->nama_produk}}" placeholder="masukkan nama produk" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Foto depan</h6>
                            <input class="form-control" type="file" name="foto_dep" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Foto belakang</h6>
                            <input class="form-control" type="file" name="foto_bel" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Satuan produk</h6>
                            <input class="form-control" type="text" name="satuan" value="{{$row->satuan}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Jenis kain</h6>
                            <input class="form-control" type="text" name="jenis_kain" value="{{$row->jenis_kain}}" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Size</h6>
                            <input class="form-control" type="text" name="size" value="{{$row->size}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Harga beli</h6>
                            <input class="form-control" type="number" name="harga_beli" value="{{$row->harga_beli}}" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Harga jual</h6>
                            <input class="form-control" type="number" name="harga_jual" value="{{$row->harga_jual}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Tanggal masuk</h6>
                            <input class="form-control" type="date" name="tgl_masuk" value="{{$row->tgl_masuk}}" aria-label="default input example">
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
@foreach($procus as $val)
<div class="modal fade" id="modalDelete{{$val->procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/procus/deleteproduk/{{$val->procus_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
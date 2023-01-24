@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data stok</h3>
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
                        <div class="fas fa-plus"></div>
                        Tambah
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama warna</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Jenis kain</th>
                                <th class="text-center">Harga beli</th>
                                <th class="text-center">Harga jual</th>
                                <th class="text-center">Tanggal masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($stok as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_warna}}</td>
                                <td>{{$val->jumlah}}</td>
                                <td>{{$val->jenis_kain}}</td>
                                <td>{{$val->harga_beli}}</td>
                                <td>{{$val->harga_jual}}</td>
                                <td>{{$val->tgl_masuk}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->stok_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->stok_id}}">
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
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/stok/addstok" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Nama warna</h6>
                            <fieldset class="form-group">
                                <select name="warna_id" id="basicSelect" class="form-select">
                                    <option selected>pilih warna stok</option>
                                    @foreach($warna as $val)
                                    <option value="{{$val->warna_id}}">{{$val->nama_warna}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jumlah</h6>
                            <input class="form-control" type="number" name="jumlah" placeholder="input jumlah" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kain</h6>
                            <input class="form-control" type="text" name="jenis_kain" placeholder="input jenis kain" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga beli</h6>
                            <input class="form-control" type="number" name="harga_beli" placeholder="input harga beli" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga jual</h6>
                            <input class="form-control" type="number" name="harga_jual" placeholder="input harga jual" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Tanggal masuk</h6>
                            <input class="form-control" type="date" name="tgl_masuk" placeholder="input tanggal masuk " aria-label="default input example">
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
@foreach($stok as $stk)
<div class="modal fade" id="modalUpdate{{$stk->stok_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/stok/updtstok" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <input type="hidden" name="stok_id" value="{{$stk->stok_id}}" class="form-control">
                            <h6>Nama warna</h6>
                            <fieldset class="form-group">
                                <select name="warna_id" id="basicSelect" class="form-select">
                                    <option value="{{$stk->warna_id}}" selected>{{$stk->nama_warna}}</option>
                                    @foreach($warna as $val)
                                    <option value="{{$val->warna_id}}">{{$val->nama_warna}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jumlah</h6>
                            <input class="form-control" type="number" name="jumlah" value="{{$stk->jumlah}}" placeholder="input jumlah" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kain</h6>
                            <input class="form-control" type="text" name="jenis_kain" value="{{$stk->jenis_kain}}" placeholder="input jenis kain" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga beli</h6>
                            <input class="form-control" type="number" name="harga_beli" value="{{$stk->harga_beli}}" placeholder="input harga beli" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga jual</h6>
                            <input class="form-control" type="number" name="harga_jual" value="{{$stk->harga_jual}}" placeholder="input harga jual" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Tanggal masuk</h6>
                            <input class="form-control" type="date" name="tgl_masuk" value="{{$stk->tgl_masuk}}" placeholder="input tanggal masuk " aria-label="default input example">
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
@foreach($stok as $val)
<div class="modal fade" id="modalDelete{{$val->stok_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/stok/delete/{{$val->stok_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
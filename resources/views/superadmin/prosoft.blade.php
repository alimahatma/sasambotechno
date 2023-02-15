@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Produk software</h3>
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
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Jenis kategori</th>
                                <th class="text-center">Jenis software</th>
                                <th class="text-center">Nama software</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($prosoft as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->jenis_kategori}}</td>
                                <td>{{$val->jenis_prosoft}}</td>
                                <td>{{$val->jenis_software}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->prosoft_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->prosoft_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->prosoft_id}}">
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
            <form action="/prosoft/addprosoft" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk software</option>
                                    @foreach($kategori as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Kategori produk custom</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_prosoft_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk software</option>
                                    @foreach($ktgrProsoft as $kpc)
                                    <option value="{{$kpc->ktgr_prosoft_id}}">
                                        {{$kpc->jenis_prosoft}}
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Nama software</h6>
                            <input class="form-control" type="text" name="jenis_software" placeholder="masukkan nama software" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Foto produk software</h6>
                            <input class="form-control" type="file" name="foto_software" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h6>Deskripsi produk</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi_prosoft" id="exampleFormControlTextarea1" rows="3"></textarea>
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

<!-- Modal update-->
@foreach($prosoft as $row)
<div class="modal fade" id="modalUpdate{{$row->prosoft_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/prosoft/updtprosoft" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-3">
                            <input type="hidden" name="prosoft_id" value="{{$row->prosoft_id}}" class="form-control">
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
                            <h6>Kategori produk software</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_prosoft_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk software</option>
                                    @foreach($ktgrProsoft as $kpc)
                                    <option value="{{$kpc->ktgr_prosoft_id}}">
                                        {{$kpc->jenis_prosoft}}
                                    </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3">
                            <h6>Nama software</h6>
                            <input class="form-control" type="text" name="jenis_software" value="{{$row->jenis_software}}" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-3">
                            <h6>Foto produk software</h6>
                            <input class="form-control" type="file" name="foto_software" value="{{$row->foto_software}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h6>Deskripsi produk software</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="deskripsi_prosoft" id="exampleFormControlTextarea1" rows="3">{{$row->deskripsi_prosoft}}</textarea>
                                    <label>masukkan deskripsi software</label>
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

<!-- modal info -->
@foreach($prosoft as $prcs)
<div class="modal modal-lg" id="modalInfo{{$prcs->prosoft_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deskripsi {{$prcs->jenis_software}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center"></h5>
                <div class="row g-0 justify-content-around">
                    <div class="col-md-4">
                        <img src="/foto_produk/{{$prcs->foto_software}}" class="img-fluid rounded-start" alt="404">
                    </div>
                </div>
                <p class="mt-3 style__font">{{$prcs->deskripsi_prosoft}}</p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- modal delete -->
@foreach($prosoft as $val)
<div class="modal fade" id="modalDelete{{$val->prosoft_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/prosoft/deleteproduk/{{$val->prosoft_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
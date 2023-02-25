@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kategori produk custom</h3>
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
                        Tambah data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Jenis kategori</th>
                                <th class="text-center">Jenis produk custom</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($ktgrProcus as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->jenis_kategori}}</td>
                                <td>{{$val->jenis_procus}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdt{{$val->ktgr_procus_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->ktgr_procus_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->ktgr_procus_id}}">
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
            <form action="/kategoriProcus/addktgrprocus" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option selected>pilih kategori produk</option>
                                    @foreach($ktgr as $valId)
                                    <option value="{{$valId->ktgr_id}}">{{$valId->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori produk</h6>
                            <input class="form-control" type="text" name="jenis_procus" placeholder="nama produk custom" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto kategori produk</h6>
                            <input class="form-control" type="file" name="foto_procus" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Deskripsi kategori</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="des_ktgrprocus" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Deskripsi kategori</label>
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

<!-- Modal info-->
@foreach($ktgrProcus as $row)
<div class="modal modal-lg" id="modalInfo{{$row->ktgr_procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$row->jenis_procus}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 mt-1 mx-auto">
                        <img src="/foto_ktgr/{{$row->foto_procus}}" alt="404" width="100%">
                    </div>
                    <div class="col-12 mt-1">
                        <p class="style__font">{{$row->des_ktgrprocus}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal update-->
@foreach($ktgrProcus as $row)
<div class="modal fade" id="modalUpdt{{$row->ktgr_procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/kategoriProcus/updtktgrprocus" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <input type="hidden" class="form-control" name="ktgr_procus_id" value="{{$row->ktgr_procus_id}}">
                            <h6>Jenis kategori</h6>
                            <fieldset class="form-group">
                                <select name="ktgr_id" id="basicSelect" class="form-select">
                                    <option value="{{$row->ktgr_id}}" selected>{{$row->jenis_kategori}}</option>
                                    @foreach($ktgr as $val)
                                    <option value="{{$val->ktgr_id}}">{{$val->jenis_kategori}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kategori produk</h6>
                            <input class="form-control" type="text" name="jenis_procus" value="{{$row->jenis_procus}}" placeholder="nama produk custom" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto kategori produk</h6>
                            <input class="form-control" type="file" name="foto_procus" value="{{$row->foto_procus}} aria-label=" default input example">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card-header">Deskripsi kategori</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="des_ktgrprocus" id="exampleFormControlTextarea1" rows="3">{{$row->des_ktgrprocus}}</textarea>
                                    <label>Deskripsi kategori</label>
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
@foreach($ktgrProcus as $res)
<div class="modal fade" id="modalDelete{{$res->ktgr_procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/kategoriProcus/delktgrprocus/{{$res->ktgr_procus_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
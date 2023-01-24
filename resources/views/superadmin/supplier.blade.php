@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Supplier</h3>
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
                                <th class="text-center">Nama supplier</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Kontak</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($supplier as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_supplier}}</td>
                                <td>{{$val->alamat}}</td>
                                <td>{{$val->contact}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-3">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->supplier_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->supplier_id}}">
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
            <form action="/supplier/addsupplier" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Nama supplier</h6>
                            <input class="form-control" type="text" name="nama_supplier" placeholder="masukkan nama supplier" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Alamat supplier</h6>
                            <input class="form-control" type="text" name="alamat" placeholder="input alamat supplier" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kontak</h6>
                            <input class="form-control" type="text" name="contact" placeholder="input kontak supplier" aria-label="default input example">
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
@foreach($supplier as $row)
<div class="modal fade" id="modalUpdate{{$row->supplier_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/supplier/updtsupplier" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <input type="hidden" name="supplier_id" value="{{$row->supplier_id}}" class="form-control">
                            <h6>Nama supplier</h6>
                            <input class="form-control" type="text" value="{{$row->nama_supplier}}" name="nama_supplier" placeholder="nama supplier" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Alamat supplier</h6>
                            <input class="form-control" type="text" value="{{$row->alamat}}" name="alamat" placeholder="input alamat supplier" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kontak</h6>
                            <input class="form-control" type="text" name="contact" value="{{$row->contact}}" placeholder="input kontak supplier" aria-label="default input example">
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
@foreach($supplier as $val)
<div class="modal fade" id="modalDelete{{$val->supplier_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/supplier/delete/{{$val->supplier_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
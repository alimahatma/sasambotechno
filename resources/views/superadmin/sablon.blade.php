@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data sablon</h3>
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
                                <th class="text-center">Ukuran sablon</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($sablon as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->ukuran_sablon}}</td>
                                <td>{{$val->harga}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-3">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->sablon_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->sablon_id}}">
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
            <form action="/sablon/addsablon" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Ukuran sablon</h6>
                            <input class="form-control" type="text" name="ukuran_sablon" placeholder="ukuran sablon" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga sablon</h6>
                            <input class="form-control" type="number" name="harga" placeholder="input harga sablon" aria-label="default input example">
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
@foreach($sablon as $row)
<div class="modal fade" id="modalUpdate{{$row->sablon_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/sablon/updtsablon" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <input type="hidden" name="sablon_id" value="{{$row->sablon_id}}" class="form-control">
                            <h6>Ukuran sablon</h6>
                            <input class="form-control" type="text" value="{{$row->ukuran_sablon}}" name="ukuran_sablon" placeholder="ukuran sablon" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Harga sablon</h6>
                            <input class="form-control" type="number" value="{{$row->harga}}" name="harga" placeholder="input harga sablon" aria-label="default input example">
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
@foreach($sablon as $val)
<div class="modal fade" id="modalDelete{{$val->sablon_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/sablon/delete/{{$val->sablon_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
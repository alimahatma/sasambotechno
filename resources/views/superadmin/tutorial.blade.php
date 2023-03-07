@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tutorials</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->name}}</p>
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
                                <th class="text-center">Judul</th>
                                <th class="text-center">Penulis</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($tutorial as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->judul}}</td>
                                <td>{{$val->penulis}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->tutorial_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->tutorial_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-2 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->tutorial_id}}">
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
            <form action="/tutorial/addtutorial" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Judul</h6>
                            <input class="form-control" type="text" name="judul" placeholder="masukkan judul artikel" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Gambar</h6>
                            <input class="form-control" type="file" name="gambar" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h6>Materi</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="materi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>masukkan materi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Penulis</h6>
                            <input class="form-control" type="text" name="penulis" placeholder="masukkan nama penulis" aria-label="default input example">
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
@foreach($tutorial as $row)
<div class="modal modal-lg" id="modalInfo{{$row->tutorial_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$row->judul}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mt-3">
                        <h6>{{$row->judul}}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mt-3 mx-auto">
                        <img src="/gambars/{{$row->gambar}}" alt="404" width="100%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                        <p class="style__font">{{$row->materi}}</p>
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

<!-- Modal update belum bisa-->
@foreach($tutorial as $row)
<div class="modal fade" id="modalUpdate{{$row->tutorial_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/tutorial/updttutorial" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" class="form-control" name="tutorial_id" value="{{$row->tutorial_id}}">
                        <div class="col-12 mt-3">
                            <h6>Judul</h6>
                            <input class="form-control" type="text" name="judul" value="{{$row->judul}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Gambar</h6>
                            <input class="form-control" type="file" name="gambar" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <h6>Materi</h6>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="materi" id="exampleFormControlTextarea1" rows="3">{{$row->materi}}</textarea>
                                    <label>masukkan materi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <h6>Penulis</h6>
                            <input class="form-control" type="text" name="penulis" value="{{$row->penulis}}" aria-label="default input example">
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
@foreach($tutorial as $val)
<div class="modal fade" id="modalDelete{{$val->tutorial_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/tutorial/deltutorial/{{$val->tutorial_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
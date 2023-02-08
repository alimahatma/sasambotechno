@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data member</h3>
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
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama lengkap</th>
                                <th class="text-center">Telepon</th>
                                <th class="text-center">Jenis kelamin</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Kabupaten</th>
                                <th class="text-center">Provinsi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($member as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->telepon}}</td>
                                <td>{{$val->gender}}</td>
                                <td>{{$val->desa}}</td>
                                <td>{{$val->kecamatan}}</td>
                                <td>{{$val->kabupaten}}</td>
                                <td>{{$val->provinsi}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->member_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->member_id}}">
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
            <form action="member/addmember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            @foreach($user as $us)
                            @if(Auth::user()->user_id == $us->user_id)
                            <input type="hidden" class="form-control" name="user_id" value="{{$us->user_id}}">
                            @endif
                            @endforeach
                            <h6>Nama lengkap</h6>
                            <input class="form-control" type="text" name="nama_lengkap" placeholder="masukkan nama lengkap" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" placeholder="telepon" aria-label="default input example" id="Success">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Jenis kelamin</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="L" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="P" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Desa</h6>
                            <input class="form-control" type="text" name="desa" placeholder="masukkan desa" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kecamatan</h6>
                            <input class="form-control" type="text" name="kecamatan" placeholder="masukkan kecamatan" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Kabupaten</h6>
                            <input class="form-control" type="text" name="kabupaten" placeholder="masukkan kabupaten" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Provinsi</h6>
                            <input class="form-control" type="text" name="provinsi" placeholder="masukkan provinsi" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer col-1 mx-auto justify-content-center">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal update-->
@foreach($member as $mbr)
<div class="modal fade" id="modalUpdate{{$mbr->member_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="member/updtmember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="member_id" value="{{$mbr->member_id}}" class="form-control">
                            @foreach($user as $us)
                            @if(Auth::user()->user_id == $us->user_id)
                            <input type="hidden" class="form-control" name="user_id" value="{{$us->user_id}}">
                            @endif
                            @endforeach
                            <h6>Nama lengkap</h6>
                            <input class="form-control" type="text" name="nama_lengkap" value="{{$mbr->nama_lengkap}}" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" value="{{$mbr->telepon}}" aria-label="default input example" id="Success">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Jenis kelamin</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="L" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="P" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Desa</h6>
                            <input class="form-control" type="text" name="desa" value="{{$mbr->desa}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kecamatan</h6>
                            <input class="form-control" type="text" name="kecamatan" value="{{$mbr->kecamatan}}" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Kabupaten</h6>
                            <input class="form-control" type="text" name="kabupaten" value="{{$mbr->kabupaten}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Provinsi</h6>
                            <input class="form-control" type="text" name="provinsi" value="{{$mbr->provinsi}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer col-1 mx-auto justify-content-center">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- modal delete -->
@foreach($member as $val)
<div class="modal fade" id="modalDelete{{$val->member_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/member/delete/{{$val->member_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
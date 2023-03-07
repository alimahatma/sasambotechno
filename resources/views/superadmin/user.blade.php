@extends('layout.template')
@section('content')

<!-- view read data user akun -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Akun user</h3>
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
                <div class="col mb-3">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        <i class="fas fa-plus"></i> Tambah data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Nama lengkap</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Hak akses</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($users as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->role}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-3 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->user_id}}">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-3 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->user_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-3 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->user_id}}">
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

<!-- modal add user -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/user/adduser" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group mt-2">
                            <div class="col">
                                <label>Username</label>
                                <input class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" name="name" placeholder="your username" aria-label="default input example" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="col">
                                <label>Email</label>
                                <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" name="email" placeholder="email@gmail.com" aria-label="default input example">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="col">
                                <label>Password</label>
                                <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password" name="password" placeholder="input password" aria-label="default input example">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <h6>Hak akses</h6>
                            <fieldset class="form-group">
                                <select name="role" id="basicSelect" class="form-select">
                                    <option selected>pilih hak akses</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="produksi">Production</option>
                                    <option value="pengguna">Pelanggan</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Register</button>
                        <!-- <button type="submit" class="btn" style="background-color: #0FAA5D; color:#fff">Register</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end-add user -->

<!-- Modal change role-->
@foreach($users as $valId)
<div class="modal fade" id="modalUpdate{{$valId->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah hak akses</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/user/change" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" class="form-control" name="user_id" value="{{$valId->user_id}}">
                            <h6>Hak akses</h6>
                            <fieldset class="form-group">
                                <select name="role" id="basicSelect" class="form-select">
                                    <option value="{{$valId->role}}" selected>{{$valId->role}}</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="kasir">Kasir</option>
                                    <option value="produksi">Production</option>
                                    <option value="pengguna">Pelanggan</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal info akun user -->
<div class="modal fade" id="modalInfo{{$valId->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Info akun {{$valId->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Nama lengkap</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->nama_lengkap}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Gender</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->gender}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Desa</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->desa}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Kecamatan</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->kecamatan}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Kabupaten</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->kabupaten}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 col-md-6 col-lg-3">
                            <h6>Provinsi</h6>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-8">
                            <p>: {{$valId->provinsi}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal hapus-->
@foreach($users as $valDel)
<div class="modal fade" id="modalDelete{{$valDel->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$valDel->user_id}}" name="produk_id">
                <p>Yakin ingin menghapus akun {{$valDel->username}} dari hak akses sebagai {{$valDel->role}}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <a href="/user/delete/{{$valDel->user_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
<script>
    // $('document').ready(function() {
    //     // setInterval(function() {
    //     GetUser()
    //     // }, 200)
    // })

    // function GetUser() {
    //     $.ajax({
    //         type: 'GET',
    //         url: '/user/data',
    //         dataType: 'json',
    //         success: function(datas) {
    //             $.each(datas.users, function(key, row) {
    //                 $('#table1 > tbody').append('<tr>\
    //                             <td>' + row.user_id + '</td>\
    //                             <td>' + row.name + '</td>\
    //                             <td>' + row.email + '</td>\
    //                             <td>' + row.role + '</td>\
    //                             <td>\
    //                         <button type="button" class="btn btn-success" value="' + row.user_id + '">edit</button>\
    //                         <button type="button" class="btn btn-danger" value="' + row.user_id + '">hapus</button></td>\
    //                         </tr>');
    //             })
    //         }
    //     })
    // }

    // function StartRealtime() {
    //     const dataUser = document.getElementById('live_user')
    //     setInterval(function() {
    //         fetch('UserController.php').then(function(response) {
    //             return response.json();
    //         }).then(function(data) {
    //             dataUser.textContent = data.live_user;
    //         }).catch(function(error) {
    //             console.log(error)
    //         })
    //     }, 200);
    // }
</script>
@endsection
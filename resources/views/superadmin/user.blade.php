@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Akun user</h3>
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
                <!-- <div class="mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        Tambah Data
                    </button>
                </div> -->
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Hak akses</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="live_user">

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
            <form action="/bidang/addBidang" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <h6>Nama bidang</h6>
                            <input class="form-control" type="text" name="nama_bidang" placeholder="Default input" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal update-->
@foreach($users as $valId)
<div class="modal fade" id="modalUpdate{{$valId->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
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
                                    <option value="super_admin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="pengguna">Pengguna</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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

<?php $i = 1; ?>
@foreach($users as $row)
<tr>
    <td>{{$i++}}</td>
    <td>{{$row->name}}</td>
    <td>{{$row->email}}</td>
    <td>{{$row->role}}</td>
</tr>
@endforeach

<script>
    $('document').ready(function() {
        // setInterval(function() {
        GetUser()
        // }, 200)
    })

    function GetUser() {
        const users = `{{$users}}`
        let el, index
        $.ajax({
            success: function() {
                users.forEach(el, index => {
                    users += `
                    <tr>
                        <td>el.index</td>
                        <td>el.name</td>
                        <td>el.email</td>
                        <td>el.role</td>
                    </tr>`
                })
                $('#live_user').html(users)
                console.log(users)
            }
        })
    }

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
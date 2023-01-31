@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Instansi</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali </p>
            </div>
            <!-- <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                    </ol>
                </nav>
            </div> -->
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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        Tambah Data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama instansi</th>
                                <th class="text-center">Logo</th>
                                <th class="text-center">Visi</th>
                                <th class="text-center">Misi</th>
                                <th class="text-center">Tentang</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Domain</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">WhatsApp</th>
                                <th class="text-center">Instagram</th>
                                <th class="text-center">Facebook</th>
                                <th class="text-center">Billing</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($instansis as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_instansi}}</td>
                                <td><img src="/logo/{{$val->logo}}" alt="404" width="120" height="60"></td>
                                <td>{{$val->visi}}</td>
                                <td>{{$val->misi}}</td>
                                <td>{{$val->tentang}}</td>
                                <td>{{$val->alamat}}</td>
                                <td>{{$val->domain}}</td>
                                <td>{{$val->email}}</td>
                                <td>{{$val->whatsapp}}</td>
                                <td>{{$val->instagram}}</td>
                                <td>{{$val->facebook}}</td>
                                <td>{{$val->billing}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->inst_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->inst_id}}">
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
            <form action="/instansi/addinstansi" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-1">
                            <h6>Nama instansi</h6>
                            <input class="form-control" type="text" name="nama_instansi" placeholder="nama perusahaan" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-1">
                            <h6>Logo</h6>
                            <input class="form-control" type="file" name="logo" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Visi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="visi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Visi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Misi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="misi" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Misi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Tentang</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tentang" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    <label>Tentang</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>Domain</h6>
                            <input class="form-control" type="text" name="domain" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Email</h6>
                            <input class="form-control" type="text" name="email" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>WhatsApp</h6>
                            <input class="form-control" type="text" name="whatsapp" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Instagram</h6>
                            <input class="form-control" type="text" name="instagram" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>Facebook</h6>
                            <input class="form-control" type="text" name="facebook" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h6>Billing</h6>
                            <input class="form-control" type="text" name="billing" aria-label="default input example">
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


<!-- Modal Edit-->
@foreach($instansi as $inst)
<div class="modal fade" id="modalUpdate{{$inst->inst_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update instansi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/instansi/updtinstansi" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6 mt-1">
                            <input type="hidden" name="inst_id" value="{{$inst->inst_id}}" class="form-control">
                            <h6>Nama instansi</h6>
                            <input class="form-control" type="text" name="nama_instansi" value="{{$inst->nama_instansi}}" placeholder="nama perusahaan" aria-label="default input example">
                        </div>
                        <div class="col-6 mt-1">
                            <h6>Logo</h6>
                            <input class="form-control" type="file" name="logo" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Visi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="visi" id="exampleFormControlTextarea1" rows="3">{{$inst->visi}}</textarea>
                                    <label>Visi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Misi</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="misi" id="exampleFormControlTextarea1" rows="3">{{$inst->misi}}</textarea>
                                    <label>Misi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="card-header">Tentang</div>
                            <div class="card-body">
                                <div class="form-group with-title mb-3">
                                    <textarea class="form-control" name="tentang" id="exampleFormControlTextarea1" rows="3">{{$inst->tentang}}</textarea>
                                    <label>Tentang</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" value="{{$inst->alamat}}" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>Domain</h6>
                            <input class="form-control" type="text" name="domain" value="{{$inst->domain}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Email</h6>
                            <input class="form-control" type="text" name="email" value="{{$inst->email}}" aria-label="default input example">
                        </div>
                        <div class="col-6">
                            <h6>WhatsApp</h6>
                            <input class="form-control" type="text" name="whatsapp" value="{{$inst->whatsapp}}" aria-label=" default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <h6>Instagram</h6>
                            <input class="form-control" type="text" name="instagram" value="{{$inst->instagram}}" aria-label=" default input example">
                        </div>
                        <div class="col-6">
                            <h6>Facebook</h6>
                            <input class="form-control" type="text" name="facebook" value="{{$inst->facebook}}" aria-label=" default input example">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h6>Billing</h6>
                            <input class="form-control" type="text" name="billing" value="{{$inst->billing}}" aria-label=" default input example">
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
@foreach($instansi as $val)
<div class="modal fade" id="modalDelete{{$val->inst_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" value="{{$val->inst_id}}" name="produk_id">
                <p>Yakin ingin menghapus data ini..?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <a href="/instansi/delete/{{$val->inst_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
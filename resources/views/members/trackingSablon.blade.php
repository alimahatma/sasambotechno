@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">List sablon</h4>
    </div>
    <div class="mt-5 col-lg-12 col-md-12 mx-auto">
        <div class="card-body">
            <div class="row">
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
                @foreach($sablon as $sab)
                <div class="card col-md-4 col-lg-3 col-sm-6 d-flex justify-content-between shadow-sm">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Ukuran sablon</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$sab->ukuran_sablon}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga sablon</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$sab->harga}}</h6>
                            </div>
                        </div>
                        <!-- Button update modal -->
                        <div class="mb-2 col-4 mx-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBeli{{$sab->sablon_id}}">
                                <i class="fas fa-shopping-bag"></i>
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@foreach($sablon as $row)
<div class="modal fade" id="modalBeli{{$row->sablon_id}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan sablon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updtmember" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" name="id_member" value="{{$row->id_member}}" class="form-control">
                            @foreach($member as $row)
                            @if(Auth::user()->user_id == $row->user_id)
                            <input type="text" class="form-control" name="member_id" value="{{$row->member_id}}">
                            @endif
                            @endforeach
                            <!-- <input class="form-control" type="text" name="nama_member" value="{{$row->nama_member}}" placeholder="nama member" aria-label="default input example" autofocus> -->
                        </div>
                        <!-- <div class="col-md-6 mb-3">
                            <h6>Tgl lahir</h6>
                            <input class="form-control" type="date" name="tgl_lhr" value="{{$row->tgl_lhr}}" placeholder="tanggal lahir" aria-label="default input example">
                        </div> -->
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Foto</h6>
                            <input class="form-control" type="file" name="foto" value="{{$row->foto}}" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Gender</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="laki-laki" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-primary">
                                    <input class="form-check-input" type="radio" name="gender" value="perempuan" id="Primary">
                                    <label class="form-check-label" for="Primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Alamat</h6>
                            <input class="form-control" type="text" name="alamat" value="{{$row->alamat}}" placeholder="alamat" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Github</h6>
                            <input class="form-control" type="text" name="github" value="{{$row->github}}" placeholder="username github" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" value="{{$row->telepon}}" placeholder="telepon" aria-label="default input example">
                        </div>
                    </div> -->
                    <div class="col mt-2">
                        <h6>Kirim desain ke nomor admin : 123456789</h6>
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
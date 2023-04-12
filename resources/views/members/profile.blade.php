@extends('layout.template')
@section('content')
<div class="content">
    <div class="card mt-5 col-lg-5 col-md-12 mx-auto shadow-lg">
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title text-center">Profile {{Auth::user()->name}}</h4>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="form">
                        <div class="modal-body">
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
                            @foreach($users as $val)
                            @if(Auth::user()->user_id == $val->user_id)
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Nama lengkap</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$val->name}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Gender</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    @if($val->gender == 'P')
                                    <h6>: {{"Perempuan"}}</h6>
                                    @elseif($val->gender == 'L')
                                    <h6>: {{"Laki-laki"}}</h6>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Desa</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$val->desa}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Kecamatan</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$val->kecamatan}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Kabupaten</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$val->kabupaten}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Provinsi</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$val->provinsi}}</h6>
                                </div>
                            </div>
                            <!-- Button update modal -->
                            <div class="d-grid gap-1 col-6 mx-auto">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$val->user_id}}">
                                    Update Profile
                                </button>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal update akun -->
@foreach($users as $us)
<div class="modal fade" id="modalUpdate{{$us->user_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{$us->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="updtakun" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" name="user_id" value="{{$us->user_id}}" class="form-control">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" value="{{$us->telepon}}" aria-label="default input example" id="Success">
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Desa</h6>
                            <input class="form-control" type="text" name="desa" value="{{$us->desa}}" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Kecamatan</h6>
                            <input class="form-control" type="text" name="kecamatan" value="{{$us->kecamatan}}" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kabupaten</h6>
                            <input class="form-control" type="text" name="kabupaten" value="{{$us->kabupaten}}" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Provinsi</h6>
                            <input class="form-control" type="text" name="provinsi" value="{{$us->provinsi}}" aria-label="default input example">
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

@endsection
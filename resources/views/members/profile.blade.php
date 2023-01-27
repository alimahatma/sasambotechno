@extends('layout.template')
@section('content')
<div class="content">
    <div class="card mt-5 col-lg-5 col-md-12 mx-auto shadow-lg">
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title text-center">Profile</h4>
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
                            @foreach($member as $mbr)
                            @if(Auth::user()->user_id == $mbr->user_id)
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Nama akun</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->name}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Nama lengkapr</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->nama_lengkap}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Gender</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->gender}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Desa</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->desa}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Kecamatan</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->kecamatan}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Kabupaten</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->kabupaten}}</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h6>Provinsi</h6>
                                </div>
                                <div class="col-md-8 mb-3">
                                    <h6>: {{$mbr->provinsi}}</h6>
                                </div>
                            </div>
                            <!-- Button update modal -->
                            <div class="mb-2 col-4 mx-auto">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$mbr->member_id}}">
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
@endsection
@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">Kurir tersedia</h4>
    </div>
    <div class="mt-5 col-lg-12 col-md-12 mx-auto">
        <div class="card-body">
            <div class="row">
                @foreach($kurir as $val)
                <div class="card mx-auto col-md-4 col-lg-3 col-sm-6 d-flex justify-content-between shadow-sm">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Jasa kirim</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$val->nama_kurir}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Jenis kurir</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$val->jenis_kurir}}</h6>
                            </div>
                        </div>
                        <!-- Button update modal -->
                        <!-- <div class="mb-2 col-4 mx-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBeli{{$val->kurir_id}}">
                                <i class="fas fa-shopping-bag"></i>
                                Detail pesanan
                            </button>
                        </div> -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
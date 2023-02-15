@extends('layout.template')
@section('content')
<div class="content">
    <div class="row">
        <div class="card-title mb-3">
            <h4 class="text-center">Jasa kirim tersedia</h4>
        </div>
        @foreach($kurir as $val)
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body shadow-sm">
                    <!-- <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <div class="row">
                        <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                            <h6>Jasa kirim</h6>
                        </div>
                        <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                            <h6>: {{$val->nama_jakir}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-5 col-sm-6 mb-3">
                            <h6>Jenis kurir</h6>
                        </div>
                        <div class="col-md-5 col-lg-7 col-sm-6 mb-3">
                            <h6>: {{$val->jenis_jakir}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
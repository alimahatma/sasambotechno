@extends('layout.template')
@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
    <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->name}}</p>
</div>
<div class="page-content">
    <section class="row">
        <div class="row">
            <!-- pesanan selesai -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldBag"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pesanan Selesai</h6>
                                <h6 class="font-extrabold mb-0">{{$pesananSelesai}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pesanan masuk -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldBag"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pesanan Masuk</h6>
                                <h6 class="font-extrabold mb-0">{{$pesananPending}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pesanan di produksi -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldBag"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Proses Produksi</h6>
                                <h6 class="font-extrabold mb-0">{{$pesananDiProduksi}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- pesanan belum di bayar -->
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldBag"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Pesanan di bayar</h6>
                                <h6 class="font-extrabold mb-0">{{$pesananDibayar}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
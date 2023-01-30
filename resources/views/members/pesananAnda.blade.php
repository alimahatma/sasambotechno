@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">Pesanan anda</h4>
    </div>
    <div class="mt-5 col-lg-12 col-md-12 mx-auto">
        <div class="card-body">
            <div class="row">
                @foreach($pesanan as $pes)
                @foreach($member as $mbr)
                @if(Auth::user()->user_id == $mbr->user_id && $mbr->member_id == $pes->member_id)
                <div class="card mx-auto col-md-4 col-lg-3 col-sm-10 d-flex justify-content-between shadow-sm">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Nama pembeli</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->nama_lengkap}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Ukuran sablon</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->ukuran_sablon}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga satuan</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->harga}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga total</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: <?= $total_harga = ($pes->jml * $pes->harga) ?></p>
                            </div>
                        </div>
                        <div class="mb-2 col-4 mx-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInfo{{$pes->trx_sablon_id}}">
                                <i class="fas fa-info"></i>
                                Detail
                            </button>
                        </div>
                    </div>
                </div>

                <!-- modal for info transaction sablon -->
                <div class="modal fade" id="modalInfo{{$pes->trx_sablon_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Nama pembeli</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$pes->nama_lengkap}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Ukuran sablon</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$pes->ukuran_sablon}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Harga satuan</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: {{$pes->harga}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Harga total</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: <?= $total_harga = ($pes->jml * $pes->harga) ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Tanggal transaksi</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: <?= $total_harga = ($pes->jml * $pes->harga) ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                        <h6>Status pesanan</h6>
                                    </div>
                                    <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                        <p>: <?= $total_harga = ($pes->jml * $pes->harga) ?></p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div> -->
                        </div>
                    </div>
                </div>

                @endif
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
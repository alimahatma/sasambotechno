@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">Pesanan anda</h4>
    </div>
    <div class="row">
        <!-- alert error or success-->
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
        <!-- end-alert -->

        @foreach($pesanansablon as $pes)
        @foreach($member as $mbr)
        @if(Auth::user()->user_id == $mbr->user_id && $mbr->member_id == $pes->member_id)
        <!-- view read transaction sablon -->
        <div class="card">
            <div class="card-body">
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
        <!-- end view read transaction sablon -->

        <!-- modal info transaction sablon -->
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
        <!-- end modal info transaction -->
        @endif
        @endforeach
        @endforeach
    </div>
    <div class="row">
        @foreach($pesananpakaiancustom as $vals)
        @foreach($member as $mbr)
        @if(Auth::user()->user_id == $mbr->user_id && $mbr->member_id == $vals->member_id)
        <!-- view read traansaction -->
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Nama pembeli</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p>: {{$vals->nama_lengkap}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Nama produk</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p>: {{$vals->nama_produk}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Warna</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p>: {{$vals->color}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Ukuran</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p>: {{$vals->size_order}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Status pesanan</h6>
                        </div>
                        @if($vals->pay_status == "pending")
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p class="text text-warning">lakukan pembayaran terlebih dahulu</p>
                        </div>
                        @elseif($vals->pay_status == "bayar")
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p class="text text-success">: pembayaran menunggu persetujuan</p>
                        </div>
                        @elseif($vals->pay_status != "pending" && $vals->pay_status != "bayar")
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p class="text text-success">: {{$vals->status_pesanan}}</p>
                        </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6>Tanggal order</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p>: {{$vals->tgl_order}}</p>
                        </div>
                    </div>
                    @if($vals->b_dp != NULL)
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                            <h6 class="text text-warning">Sisa bayar</h6>
                        </div>
                        <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                            <p class="text text-warning">: <?= $sisa = ($vals->jml_order * $vals->harga_jual) - $vals->jml_dp ?></p>
                        </div>
                    </div>
                    @endif
                    <div class="mb-4 col-10 d-flex justify-content-between mx-auto">
                        <div class="col-4">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$vals->pesanan_id}}">
                                <i class="fas fa-info"></i>
                                Detail
                            </button>
                        </div>
                        @if($vals->status_pesanan != 'selesai')
                        @if($vals->pay_method == 'Cash' || $vals->b_dp != NULL)
                        <div class="col-4">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayarLunas{{$vals->pesanan_id}}">
                                <i class="fas fa-dollar-sign"></i>
                                Bayar
                            </button>
                        </div>
                        @elseif($vals->pay_method != 'Cash')
                        <div class="col-5">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayar{{$vals->pesanan_id}}">
                                <i class="fas fa-dollar-sign"></i>
                                Bayar dp
                            </button>
                        </div>
                        @endif
                        @elseif($vals->status_pesanan == 'selesai')
                        <a href="/home" class="btn btn-primary">Beli lagi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end view read transaction -->

        <!-- modal info transaction sablon -->
        <div class="modal fade" id="modalInfo{{$vals->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail {{$vals->nama_produk}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Nama pembeli</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->nama_lengkap}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Jasa kirim</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->nama_jakir}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Metode pembayaran</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->pay_method}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Ukuran sablon</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->ukuran_sablon}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga satuan</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->harga_jual}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Jumlah order</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->jml_order}}/{{$vals->satuan}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Tanggal order</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->tgl_order}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga total</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: Rp. <?= $total_harga = ($vals->jml_order * $vals->harga_jual) ?></p>
                            </div>
                        </div>
                        @if($vals->b_dp != NULL)
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Jumlah DP</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p class="text text-success">: Rp. <?= $vals->jml_dp ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6 class="text text-warning">Sisa bayar</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p class="text text-warning">: Rp. <?= $sisa = ($vals->jml_order * $vals->harga_jual) - $vals->jml_dp ?></p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal info transaction -->

        <!-- Modal bayar dp-->
        <div class="modal fade" id="modalBayar{{$vals->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran {{$vals->pay_method}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/pesanan/bayar" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="col mb-3">
                                <p class="card-text">Total produk = Rp. {{$vals->jml_order * $vals->harga_jual}}</p>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" name="pesanan_id" value="{{$vals->pesanan_id}}" class="form-control">
                                    <p>Jumlah DP</p>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jml_dp" placeholder="masukkan jumlah DP">
                                        <input type="text" class="form-control" name="pay_status" value="bayar">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>Upload bukti DP</p>
                                    <div class="col">
                                        <input type="file" class="form-control" name="b_dp">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal bayar dp -->

        <!-- Modal bayar Lunas-->
        <div class="modal fade" id="modalBayarLunas{{$vals->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran {{$vals->pay_method}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/pesanan/bayarlunas" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <input type="text" name="pesanan_id" value="{{$vals->pesanan_id}}" class="form-control">
                                    <p>Total bayar</p>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jml_lunas" value="{{$vals->jml_order * $vals->harga_jual}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p>Upload bukti lunas</p>
                                    <div class="col">
                                        <input type="file" class="form-control" name="b_lunas">
                                        <!-- <input type="hidden" name="pay_status" value="bayar" class="form control"> -->
                                        <input type="hidden" class="form-control" name="pay_status" value="bayar">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end modal bayar lunas -->
        @endif
        @endforeach
        @endforeach
    </div>
</div>
@endsection
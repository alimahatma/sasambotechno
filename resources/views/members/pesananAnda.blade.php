@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center mb-3">Pesanan saya</h4>
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

        @foreach($data_pesanan as $pes)
        @if(Auth::user()->user_id == $pes->user_id && $pes->sablon_id == TRUE)
        <!-- view read transaction sablon -->
        <div class="card">
            <div class="card-body shadow-sm">
                <div class="row align-items-center">
                    <div class="col">
                        <p>{{$pes->name}}</p>
                    </div>
                    <div class="col">
                        <p>Alamat {{$pes->desa}}</p>
                    </div>
                    <div class="col">
                        <p>Sablon. {{$pes->ukuran_sablon}}</p>
                    </div>
                    <div class="col">
                        <p>X. {{$pes->jml_order}}</p>
                    </div>
                    <div class="col">
                        <p>Rp. {{$pes->harga}} / titik</p>
                    </div>
                    @if($pes->pay_status == "pending")
                    <div class="col">
                        <p class="text text-warning">lakukan pembayaran terlebih dahulu</p>
                    </div>
                    @elseif($pes->pay_status == "bayar")
                    <div class="col">
                        <p class="text text-success">pembayaran menunggu persetujuan</p>
                    </div>
                    @elseif($pes->pay_status != "pending" && $pes->pay_status != "bayar")
                    <div class="col">
                        <p class="text text-success">pesanan {{$pes->status_pesanan}}</p>
                    </div>
                    @endif
                    <div class="col">
                        <p>{{$pes->tgl_order}}</p>
                    </div>
                    @if($pes->b_dp != NULL && $pes->b_lunas == NULL)
                    <div class="col">
                        <h6 class="text text-warning">Sisa bayar</h6>
                    </div>
                    <div class="col">
                        <p class="text text-warning">: <?= $sisa = ($pes->jml_order * $pes->harga_satuan) - $pes->jml_dp ?></p>
                    </div>
                    @elseif($pes->b_dp == TRUE && $pes->b_lunas == TRUE)
                    <div class="col">
                        <h6 class="text text-success">Lunas</h6>
                    </div>
                    <div class="col">
                        <p class="text text-success">: <?= $sisa = ($pes->jml_order * $pes->harga_satuan) - ($pes->jml_dp + $pes->jml_lunas) ?></p>
                    </div>
                    @endif
                </div>

                <!-- button modals -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfoSablon{{$pes->pesanan_id}}">
                        <i class="fas fa-info"></i>
                        Detail
                    </button>
                    @if($pes->status_pesanan != 'selesai')
                    @if($pes->pay_method == 'Cash' || $pes->b_dp != NULL)
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayarLunasSablon{{$pes->pesanan_id}}">
                        <i class="fas fa-dollar-sign"></i>
                        Bayar
                    </button>
                    @elseif($pes->pay_method != 'Cash')
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayarDpSablon{{$pes->pesanan_id}}">
                        <i class="fas fa-dollar-sign"></i>
                        Bayar dp
                    </button>
                    @endif
                    @elseif($pes->status_pesanan == 'selesai')
                    <a href="/home" class="btn btn-outline-success">Beli lagi</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- end view read transaction sablon -->

        <!-- modal info transaction sablon -->
        <div class="modal fade" id="modalInfoSablon{{$pes->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan sablon {{$pes->ukuran_sablon}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Nama pembeli</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->name}}</p>
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
                                <h6>Jasa kirim</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->nama_jakir}} {{$pes->jenis_jakir}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Metode pembayaran</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->pay_method}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Jumlah order</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$pes->jml_order}} / titik</p>
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
                                <p>: Rp. <?= $total_harga = ($pes->jml_order * $pes->harga) ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Status pesanan</h6>
                            </div>
                            @if($pes->pay_status == "pending")
                            <div class="col">
                                <p class="text text-warning">: lakukan pembayaran terlebih dahulu</p>
                            </div>
                            @elseif($pes->pay_status == "bayar")
                            <div class="col">
                                <p class="text text-success">: pembayaran menunggu persetujuan</p>
                            </div>
                            @elseif($pes->pay_status != "pending" && $pes->pay_status != "bayar")
                            <div class="col">
                                <p class="text text-success">: pesanan {{$pes->status_pesanan}}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($pes->b_dp != NULL && $pes->b_lunas == NULL)
                            <div class="col">
                                <h6 class="text text-warning">Sisa bayar</h6>
                            </div>
                            <div class="col">
                                <p class="text text-warning">: <?= $sisa = ($pes->jml_order * $pes->harga_satuan) - $pes->jml_dp ?></p>
                            </div>
                            @elseif($pes->b_dp == TRUE && $pes->b_lunas == TRUE)
                            <div class="col">
                                <h6 class="text text-success">Lunas</h6>
                            </div>
                            <div class="col">
                                <p class="text text-success">: <?= $sisa = ($pes->jml_order * $pes->harga_satuan) - ($pes->jml_dp + $pes->jml_lunas) ?></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal info transaction -->
        @endif
        @endforeach
    </div>

    <div class="row">
        @foreach($data_pesanan as $vals)
        @if(Auth::user()->user_id == $vals->user_id && $vals->procus_id == TRUE)

        <!-- view read transaction pesanan pakaian custom -->
        <div class="card">
            <div class="card-body shadow-sm">
                <div class="row align-items-center">
                    <div class="col">
                        <img src="/foto_produk/depan/{{$vals->foto_dep}}" width="100px" height="130px" alt="404">
                    </div>
                    <div class="col">
                        <p>{{$vals->name}}</p>
                    </div>
                    <div class="col">
                        <p>{{$vals->nama_produk}}</p>
                    </div>
                    <div class="col">
                        <p>Warna. {{$vals->nama_warna}}</p>
                    </div>
                    <div class="col">
                        <p>Size. {{$vals->size_orders}}</p>
                    </div>
                    <div class="col">
                        <p>X. {{$vals->jml_order}}</p>
                    </div>
                    @if($vals->pay_status == "pending")
                    <div class="col">
                        <p class="text text-warning">lakukan pembayaran terlebih dahulu</p>
                    </div>
                    @elseif($vals->pay_status == "bayar")
                    <div class="col">
                        <p class="text text-success">pembayaran menunggu persetujuan</p>
                    </div>
                    @elseif($vals->pay_status != "pending" && $vals->pay_status != "bayar")
                    <div class="col">
                        <p class="text text-success">pesanan {{$vals->status_pesanan}}</p>
                    </div>
                    @endif
                    <div class="col">
                        <p>{{$vals->tgl_order}}</p>
                    </div>
                    @if($vals->b_dp != NULL && $vals->b_lunas == NULL)
                    <div class="col">
                        <h6 class="text text-warning">Sisa bayar</h6>
                    </div>
                    <div class="col">
                        <p class="text text-warning">: <?= $sisa = ($vals->jml_order * $vals->harga_satuan) - $vals->jml_dp ?></p>
                    </div>
                    @elseif($vals->b_dp == TRUE && $vals->b_lunas == TRUE)
                    <div class="col">
                        <h6 class="text text-success">Lunas</h6>
                    </div>
                    <div class="col">
                        <p class="text text-success">: <?= $lunas = ($vals->jml_dp + $vals->jml_lunas) ?></p>
                    </div>
                    @endif

                    <!-- button modals -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfoProduks{{$vals->pesanan_id}}">
                            <i class="fas fa-info"></i>
                            Detail
                        </button>
                        @if($vals->status_pesanan != 'selesai')
                        @if($vals->pay_method == 'Cash' || $vals->b_dp != NULL)
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayarLunas{{$vals->pesanan_id}}">
                            <i class="fas fa-dollar-sign"></i>
                            Bayar
                        </button>
                        @elseif($vals->pay_method != 'Cash')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBayar{{$vals->pesanan_id}}">
                            <i class="fas fa-dollar-sign"></i>
                            Bayar dp
                        </button>
                        @endif
                        @elseif($vals->status_pesanan == 'selesai')
                        <a href="/home" class="btn btn-outline-success">Beli lagi</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end view read transaction pesanan pakaian custom -->

        <!-- modal info transaction pesanan pakaian custom -->
        <div class="modal fade" id="modalInfoProduks{{$vals->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail pesanan {{$vals->nama_produk}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6>Nama pembeli</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->name}}</p>
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
                                <h6>Harga satuan</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p>: {{$vals->harga_satuan}}</p>
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
                                <p>: Rp. <?= $total_harga = ($vals->jml_order * $vals->harga_satuan) ?></p>
                            </div>
                        </div>
                        @if($vals->b_dp != NULL && $vals->b_lunas == NULL)
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
                                <p class="text text-warning">: Rp. <?= $sisa = ($vals->jml_order * $vals->harga_satuan) - $vals->jml_dp ?></p>
                            </div>
                        </div>
                        <div class="d-grid gap-1 col-6 mx-auto">
                            <button type="button" class="btn btn-outline-success"><i class="fas fa-file-pdf"></i>Cetak Invoice</button>
                        </div>
                        @elseif($vals->b_dp == TRUE && $vals->b_lunas == TRUE)
                        <div class="row">
                            <div class="col-md-4 col-lg-6 col-sm-6 mb-3">
                                <h6 class="text text-success">Lunas</h6>
                            </div>
                            <div class="col-md-3 col-lg-5 col-sm-6 mb-3">
                                <p class="text text-success">: <?= $lunas = ($vals->jml_dp + $vals->jml_lunas) ?></p>
                            </div>
                        </div>
                        <div class="d-grid gap-1 col-6 mx-auto">
                            <button type="button" class="btn btn-outline-success"><i class="fas fa-file-pdf"></i>Cetak Invoice</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal info transaction pesanan pakaian custom -->

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
                                <p class="card-text">Total produk = Rp. {{$vals->jml_order * $vals->harga_satuan}}</p>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="hidden" name="pesanan_id" value="{{$vals->pesanan_id}}" class="form-control">
                                    <p>Jumlah DP</p>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jml_dp" placeholder="masukkan jumlah DP">
                                        <input type="hidden" class="form-control" name="pay_status" value="bayar">
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
                                    <input type="hidden" name="pesanan_id" value="{{$vals->pesanan_id}}" class="form-control">
                                    <p>Total bayar</p>
                                    <div class="col">
                                        <input type="number" class="form-control" name="jml_lunas" value="{{($vals->jml_order * $vals->harga_satuan)-($vals->jml_dp)}}">
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
    </div>
</div>
@endsection
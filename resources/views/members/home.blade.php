@extends('layout.template')
@section('content')
<div class="row row-cols-1 row-cols-md-2 g-4">

    <!-- view data kategori produk custom -->
    <div class="col-6">
        <div class="card-header">
            <h5 class="text-center mt-1 mb-3">
                Kategori produk custom
            </h5>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($kategoricustom as $ktgr)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-1">
                        <a href="#{{$ktgr->ktgr_procus_id}}">
                            <img src="/foto_ktgr/{{$ktgr->foto_procus}}" class="card-img-top" alt="...">
                        </a>
                    </div>
                    <div class="card-footer latar__belakang">
                        <h6 class="color-teks text text-center">{{$ktgr->jenis_procus}}</h6>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- view data sablon -->
    <div class="col-6">
        <div class="card-header">
            <h5 class="text-center mt-1 mb-3">
                Jasa sablon
            </h5>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($sablon as $val)
            @if($val->harga !=0)
            <div class="col">
                <form action="/addsablontocart" method="post">
                    @csrf
                    <div class="card h-100 card-body shadow-sm">
                        <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                        <input type="hidden" name="sablon_id" value="{{$val->sablon_id}}">
                        <input type="hidden" name="jumlah_order" value="1">
                        <div class="row">
                            <div class="col-5">
                                <h6>Ukuran</h6>
                            </div>
                            <div class="col-6">
                                <p class="card-text">{{$val->ukuran_sablon}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <h6>Harga</h6>
                            </div>
                            <div class="col-6">
                                <p class="card-text">Rp. {{$val->harga}}
                                    <input type="hidden" value="{{$val->harga}}">
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalBeli{{$val->sablon_id}}">
                                <i class="fas fa-dollar-sign"></i>
                                <button class="btn btn-outline-warning" type="submit"><i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            @endif

            <!-- user_id	sablon_id	kurir_id	payment_id	bdp	bl	jml	pay_status	stts_produksi	trx_status -->
            <!-- modal beli lngsung sablon -->
            <div class="modal fade" id="modalBeli{{$val->sablon_id}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan sablon</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="pesanan/pesanlangsungsablon" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->user_id}}">
                                        <input type="hidden" class="form-control" name="sablon_id" value="{{$val->sablon_id}}" aria-label="default input example" autofocus>
                                    </div>
                                    <!-- input id metode pembayaran -->
                                    <div class="col-12 mb-3">
                                        <h6>Kurir</h6>
                                        <select name="kurir_id" class="form-select" aria-label="Default select example">
                                            <option selected>pilih jasa kirim</option>
                                            @foreach($kurir as $row)
                                            <option value="{{$row->kurir_id}}">{{$row->nama_jakir}}, {{$row->jenis_jakir}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Metode pembayaran</h6>
                                        <select name="payment_id" class="form-select" aria-label="Default select example">
                                            <option selected>pilih metode</option>
                                            @foreach($payment as $pay)
                                            <option value="{{$pay->payment_id}}">{{$pay->pay_method}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Jumlah</h6>
                                        <!-- <input type="number" id="jml_order_langsung" name="jml_order" class="form-control"> -->
                                        <input type="number" id="jml_order_langsung" name="jml_order" onchange="jmlOrderLangsung()" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Harga satuan Rp. {{$val->harga}}</h6>
                                        <input type="hidden" id="harga_satuan_langsung" data-ordersablon="{{$val->harga}}">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Total</h6>
                                        <p id="harga_total_sablon"></p>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="card-header">Tinggalkan pesan</div>
                                        <div class="card-body">
                                            <div class="form-group with-title mb-3">
                                                <textarea class="form-control" name="t_pesan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                <label>tinggalkan pesan untuk pesanan sablon anda</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="hidden" class="form-control" name="tgl_order" value="{{date('Y/m/d')}}" aria-label="default input example">
                                    </div>
                                    <div class="col-12 mt-2">
                                        @foreach($instansi as $inst)
                                        <h6>Kirim desain ke nomor admin : {{$inst->whatsapp}}</h6>
                                        @endforeach
                                    </div>
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
            <!-- end-modal beli langsung sablon -->

            @endforeach
        </div>
    </div>
</div>

<!-- produk custom -->
<div class="col-12 mt-5">
    <div class="card-header">
        <h5 class="text-center mt-1">
            Produk custom
        </h5>
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-4">
        @foreach($produk_custom as $pro)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <a id="{{$pro->procus_id}}" href="/details/{{$pro->procus_id}}">
                    <div class="card-body p-1">
                        <img src="/foto_produk/depan/{{$pro->foto_dep}}" class="card-img-top" alt="404">
                        <a href="/details/{{$pro->procus_id}}" class="text__nodecoration" style="color: #0FAA5D;">{{$pro->nama_produk}}</a>
                        <br>
                        <del style="font-size: 12px;" class="text text-danger">Rp. {{$pro->harga_satuan + 5000}}</del>
                        <h6 style="color: #0FAA5D;">Rp. {{$pro->harga_satuan}}</h6>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- end produk custom -->

<script>
    function jmlOrderLangsung() {
        let getJumlahOrderLangsung = document.getElementById('jumlah_order_langsung');
        let gethargaSatuanLangsung = document.getElementById('harga_satuan_langsung').getAttribute('data-ordersablon');
        console.log(gethargaSatuanLangsung);
        console.log(getJumlahOrderLangsung);
        let TotalHargaLangsung = getJumlahOrderLangsung * gethargaSatuanLangsung;
        document.getElementById('harga_total_langsung').innerHTML = "Rp. " + TotalHargaLangsung;
    }
</script>

@endsection
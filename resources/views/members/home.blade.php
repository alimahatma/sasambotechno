@extends('layout.template')
@section('content')
<div class="row row-cols-1 row-cols-md-2 g-4">

    <!-- view data kategori produk custom -->
    <div class="col-6">
        <div class="card-header">
            <h5 class="text-center mt-1 mb-5">
                Kategori produk custom
            </h5>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($kategoricustom as $ktgr)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="#{{$ktgr->ktgr_procus_id}}">
                        <img src="/foto_ktgr/{{$ktgr->foto_procus}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h6>{{$ktgr->jenis_procus}}</h6>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- view data sablon -->
    <div class="col-6">
        <div class="card-header">
            <h5 class="text-center mt-1 mb-5">
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
                                <i class="fas fa-money-check-alt"></i></button>
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
                        <form action="trx_sablon/addtrxSablon" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->user_id}}">
                                        <input class="form-control" type="hidden" name="sablon_id" value="{{$val->sablon_id}}" aria-label="default input example" autofocus>
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
                                        <h6>Harga satuan Rp. {{$val->harga}}</h6>
                                        <input type="hidden" value="{{$val->harga}}" id="hargaSablon">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Jumlah</h6>
                                        <input type="number" id="jumlah_order" name="jml" class="form-control">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <h6>Total</h6>
                                        <input type="number" name="harga_totals" id="total" class="form-control" placeholder="Total">
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="card-header">Tinggalkan pesan</div>
                                        <div class="card-body">
                                            <div class="form-group with-title mb-3">
                                                <textarea class="form-control" name="tinggalkanpesan" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                <label>tinggalkan pesan untuk pesanan sablon anda</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input class="form-control" type="hidden" name="tgl_trx" value="{{date('Y/m/d')}}" aria-label="default input example">
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
        <h5 class="text-center">
            Produk custom
        </h5>
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-4 mt-1">
        @foreach($produk_custom as $pro)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <a id="{{$pro->procus_id}}" href="/details/{{$pro->procus_id}}">
                    <img src="/foto_produk/depan/{{$pro->foto_dep}}" class="card-img-top mt-3" alt="404">
                    <div class="card-body">
                        <a href="/details/{{$pro->procus_id}}" class="text__nodecoration color__green">{{$pro->nama_produk}}</a>
                        <br>
                        <del style="font-size: 12px;">Rp. {{$pro->harga_jual}}</del>
                        <h6 style="color: #0FAA5D;">Rp. {{$pro->harga_jual}}</h6>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- end produk custom -->

<script>
    // function count total harga
    // $(document).ready(function() {
    //     let harga = document.getElementById('hargaSablon')
    //     let jumlah = document.getElementById('jumlah_order')
    //     let www = harga * jumlah
    //     console.log(www)
    // console.log(jumlah)

    // $(`#jumlah_order, #hargaSablon`).keyup(function() {
    //     let harga_juals = $("#hargaSablon").val(); //get value from input id harga jual
    //     let jmls = $("#jumlah_order").val(); //get jumlah order from input order
    //     console.log(harga_juals)
    //     let total = harga_juals * jmls; //count harga jual and jumlah harga
    //     $("#total").val(total); //return value total to input total
    // });
    // });
</script>

@endsection
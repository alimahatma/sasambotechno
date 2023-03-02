@extends('layout.template')
@section('content')
<div class="content" id="datamains" data-loading="true">
    <div class="mt-5 col-lg-10 col-md-11 col-sm-12 mx-auto">
        <div class="card-body">
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
                <div class="col-md-12 mx-auto">
                    <!-- <div class="form"> -->
                    <form id="FormProduk" action="/addtocart" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <!-- code read image -->
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <!-- menampilkan foto depan produk -->
                                    <img id="main-image" class="d-block w-100" src="/foto_produk/depan/{{$getProdukCustomById->foto_dep}}" alt="404" height="400px" alt="404">
                                    <div class="scrollmenu d-flex">
                                        @foreach($getProdukCustomIfTogetherWithKategoriProdukCustom as $gm)
                                        <img id="d{{$gm->foto_dep}}" src="/foto_produk/depan/{{$gm->foto_dep}}" class="d-block w-100" height="100px" alt="404" onclick="return tampil('/foto_produk/depan/<?= $gm->foto_dep; ?>')">
                                        <img id="b{{$gm->foto_bel}}" src="/foto_produk/belakang/{{$gm->foto_bel}}" class="d-block w-100" height="100px" alt="404" onclick="return tampil('/foto_produk/belakang/<?= $gm->foto_bel; ?>')">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="shadow-none">
                                        <div class="card-body">
                                            <!-- input data id prdk custom dan get harga produk-->
                                            <div class="col">
                                                <h5 class="card-title color__green">{{$getProdukCustomById->nama_produk}}</h5>
                                                <h6 class="card-title color__green">Rp. {{$getProdukCustomById->harga_jual}}</h6>
                                                <input type="hidden" name="ktgr_procus_id" value="{{$getProdukCustomById->ktgr_procus_id}}"> <!-- ambil data id produk custom-->
                                                <input type="hidden" name="harga_satuan" value="{{$getProdukCustomById->harga_jual}}" id="harga_jual"> <!--mengambil harga barang menngunakan input-->
                                            </div>

                                            <!-- menampilkan jenis kain produk -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jenis kain</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <p class="card-text">{{$getProdukCustomById->jenis_kain}}</p>
                                                </div>
                                            </div>

                                            <!-- input user id -->
                                            <div>
                                                <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                                            </div>

                                            <!-- input warna -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Pilih warna</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select name="warna_id" class="form-select" aria-label="Default select example">
                                                        <option selected>pilih warna</option>
                                                        @foreach($getProdukCustomIfTogetherWithKategoriProdukCustom as $col)
                                                        @foreach($colors as $war)
                                                        @if($war->warna_id == $col->warna_id)
                                                        <option value="{{$col->warna_id}}">{{$war->nama_warna}}</option>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- input size -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Size</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8 d-flex justify-content-between">
                                                    @foreach($getProdukCustomIfTogetherWithKategoriProdukCustom as $prd)
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="radio" name="procus_id" value="{{$prd->procus_id}}" id="GetValueSize flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">{{$prd->size}}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- input jumlah order -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jumlah order</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <input type="number" id="jml" name="jumlah_order" class="form-control">
                                                </div>
                                            </div>
                                            <div>
                                                @foreach($kategori_produk_custom as $row)
                                                @foreach($getProdukCustomByPaginate as $produkPaginate)
                                                @if(($row->ktgr_procus_id == $id) && ($produkPaginate->ktgr_procus_id == $row->ktgr_procus_id))
                                                <input type="hidden" name="harga_satuan" value="{{$produkPaginate->harga_jual}}" id="harga_jual">
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </div>

                                            <!-- total produk -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Total produk</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="harga_totals" id="total" class="form-control" placeholder="Total" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-3">
                                        <h6>Deskripsi : </h6>
                                        <p class="card-text style__font">{{$prd->deskripsi}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- tombol beli dan tambahkan ke keranjang -->
                        <div class="mb-2 mt-4 col-3 mx-auto d-flex justify-content-between">
                            <button id="BeliProduk" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalBLangsung{{$prd->procus_id}}">
                                <span><i class="fas fa-dollar-sign"></i></span>
                                Beli
                            </button>
                            <button id="AddToCart" type="submit" class="btn btn-outline-warning" data-bs-dismiss="modal">
                                <span><i class="fas fa-shopping-cart"></i></span>
                                Keranjang
                            </button>
                        </div>
                    </form>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBLangsung{{$prd->procus_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="row">
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
<script>
    // function count total harga
    $(document).ready(function() {
        $("#jml, #harga_jual").keyup(function() {
            var harga_juals = $("#harga_jual").val(); //get value from input id harga jual
            var jmls = $("#jml").val(); //get jumlah order from input order

            var total = harga_juals * jmls; //count harga jual and jumlah harga
            $("#total").val(total); //return value total to input total
        });
        DataCustom()
    });

    // function show and hidden element after select sablon
    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value >= 2 ? 'block' : 'none'; //condition ternary for show and hidden element
    }

    function tampil(a) {
        document.getElementById('main-image').removeAttribute('src');
        document.getElementById('main-image').setAttribute('src', a);

    }
</script>
@endsection
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
                @foreach($data_produk_custom as $val)
                @if($val->procus_id == $data_produk_custom_id)
                <!-- tambahkan produk custom ke keranjang -->
                <div class="col-md-12 mx-auto">
                    <!-- <div class="form"> -->
                    <form id="FormProduk" action="/addtocart" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <!-- code read image -->
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <!-- menampilkan foto depan produk -->
                                    <img id="main-image" class="d-block w-100" src="/foto_produk/depan/{{$val->foto_dep}}" alt="404" height="400px" alt="404">
                                    <div class="scrollmenu d-flex mt-1">
                                        <img id="d{{$val->foto_dep}}" src="/foto_produk/depan/{{$val->foto_dep}}" class="d-block w-100" height="100px" onclick="return tampil('/foto_produk/depan/<?= $val->foto_dep; ?>')">
                                        <img id="b{{$val->foto_bel}}" src="/foto_produk/belakang/{{$val->foto_bel}}" class="d-block w-100" height="100px" onclick="return tampil('/foto_produk/belakang/<?= $val->foto_bel; ?>')">
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="shadow-none">
                                        <div class="card-body">
                                            <!-- input data id prdk custom dan get harga produk-->
                                            <div class="col">
                                                <h5 class="card-title color__green">{{$val->nama_produk}}</h5>
                                                <h6 class="card-title color__green">Rp. {{$val->harga_satuan}}</h6>
                                                <input type="hidden" name="procus_id" value="{{$val->procus_id}}"> <!-- ambil data id produk custom-->
                                                <input type="hidden" name="harga_satuan" value="{{$val->harga_satuan}}" id="harga_satuan"> <!--mengambil harga barang menngunakan input-->
                                            </div>

                                            <!-- menampilkan jenis kain produk -->
                                            <div class="input-group mt-2">
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jenis kain</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-7 col-md-8">
                                                    <p class="card-text">{{$val->jenis_kain}}</p>
                                                </div>
                                            </div>

                                            <!-- input user id -->
                                            <div>
                                                <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                                            </div>

                                            <!-- menampilkan warna pakaian custom-->
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Warna</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-7 col-md-8">
                                                    <p class="card-text">{{$val->nama_warna}}</p>
                                                </div>
                                            </div>
                                            <!-- menampilkan warna pakaian custom-->
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jumlah stok</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-7 col-md-8">
                                                    <p class="card-text">{{$val->jml_stok}} {{$val->satuan}}</p>
                                                </div>
                                            </div>

                                            <!-- input size -->
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-5">
                                                    <h6>Size</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-5 col-md-5 justify-content-between">
                                                    <?php $pecahkan = explode(',', $val->size); ?>
                                                    <?php foreach ($pecahkan as $key) : ?>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="size_order" value="{{$key}}" id="inlineRadio1" value="option1">
                                                            <label class="form-check-label" for="inlineRadio1">{{$key}}</label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>

                                            <!-- input jumlah order -->
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jumlah order</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-7 col-md-8">
                                                    <input type="number" id="jml" name="jumlah_order" class="form-control form-control-sm">
                                                    <input type="hidden" name="harga_satuan" value="{{$val->harga_satuan}}" id="harga_satuan">
                                                </div>
                                            </div>

                                            <!-- total produk -->
                                            <div class="row mt-3">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Total produk</h6>
                                                </div>
                                                <div class="col-lg-4 col-sm-7 col-md-8">
                                                    <div class="form-group mb-0">
                                                        <input type="text" name="harga_totals" id="total" class="form-control form-control-sm" placeholder="Total" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mt-3">
                                        <h6>Deskripsi : </h6>
                                        <p class="card-text style__font">{{$val->deskripsi_kategori_produk_custom}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- tombol beli dan tambahkan ke keranjang -->
                        <div class="d-grid gap-2 col-6 mx-auto mt-1">
                            <button class="btn btn-outline-success" type="button">
                                <span><i class="fas fa-dollar-sign"></i></span>Beli</button>
                            <button class="btn btn-outline-warning" type="submit"><span><i class="fas fa-shopping-cart"></i></span>Add cart</button>
                        </div>
                    </form>
                </div>
                <!-- end modal tambah barang ke keranjang -->
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    // function count total harga
    $(document).ready(function() {
        $("#jml, #harga_satuan").keyup(function() {
            var harga_juals = $("#harga_satuan").val(); //get value from input id harga jual
            var jmls = $("#jml").val(); //get jumlah order from input order

            var total = harga_juals * jmls; //count harga jual and jumlah harga
            $("#total").val(total); //return value total to input total
        });
        DataCustom()
    });

    // ganti foto produk berdasarkan gambar yang di klik
    function tampil(a) {
        document.getElementById('main-image').removeAttribute('src');
        document.getElementById('main-image').setAttribute('src', a);
    }
</script>
@endsection
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
                    <form action="/pesanan/addpesanan" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <!-- code read image -->
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <?php $i = 1; ?>
                                    @foreach($kategori_produk_custom as $row)
                                    @foreach($produkcustoms as $prdklimit)
                                    @if(($row->ktgr_procus_id == $id) && ($prdklimit->ktgr_procus_id == $row->ktgr_procus_id))
                                    <img src="/foto_produk/{{$prdklimit->foto_dep}}" alt="404" class="main-image d-block w-100" height="400px" alt="404">
                                    @endif
                                    @endforeach
                                    @endforeach
                                    <div class="scrollmenu d-flex">
                                        <?php $i = 0; ?>
                                        <?php $j = 0; ?>
                                        @foreach($procus as $prd)
                                        @foreach($prdkgroup as $prg)
                                        @if($prd->ktgr_procus_id == $id)
                                        @if($prd->nama_produk == $prg->nama_produk)
                                        {{$i++}}
                                        {{$j++}}
                                        <img src="/foto_produk/{{$prd->foto_dep}}" id="featured-dep<?= $i++ ?>" class="d-block w-100" height="100px" alt="404">
                                        <img src="/foto_produk/{{$prd->foto_bel}}" id="featured-bel<?= $j++ ?>" class="d-block w-100" height="100px" alt="404">
                                        @endif
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="shadow-none">
                                        <div class="card-body">
                                            <!-- input data id prdk custom dan get harga produk-->
                                            <div class="col">
                                                @foreach($kategori_produk_custom as $row)
                                                @foreach($produkcustoms as $prdklimit)
                                                @if(($row->ktgr_procus_id == $id) && ($prdklimit->ktgr_procus_id == $row->ktgr_procus_id))
                                                <h5 class="card-title color__green">{{$prdklimit->nama_produk}}</h5>
                                                <h6 class="card-title color__green">Rp. {{$prdklimit->harga_jual}}</h6>
                                                <input type="hidden" name="procus_id" value="{{$prdklimit->procus_id}}"> <!-- ambil data id produk custom-->
                                                <input type="hidden" value="{{$prdklimit->harga_jual}}" id="harga_jual"> <!--mengambil harga barang menngunakan input-->
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </div>
                                            <!-- menampilkan jenis kain produk -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jenis kain</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <p class="card-text">: {{$prd->jenis_kain}}</p>
                                                </div>
                                            </div>
                                            <!-- input warna -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Pilih warna</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select name="color" class="form-select" aria-label="Default select example">
                                                        <option selected>pilih warna</option>
                                                        @foreach($colors as $col)
                                                        @foreach($procolor as $prclr)
                                                        @if($prclr->ktgr_procus_id == $id && $prclr->nama_warna == $col->nama_warna)
                                                        <option value="{{$prclr->nama_warna}}">{{$prclr->nama_warna}}</option>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- input user id -->
                                            <div>
                                                <input type="hidden" name="user_id" value="{{Auth::user()->user_id}}">
                                            </div>
                                            <!-- input size -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Size</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8 d-flex justify-content-between">
                                                    @foreach($procus as $prd)
                                                    @foreach($prdkgroup as $prg)
                                                    @if($prd->ktgr_procus_id == $id)
                                                    @if($prd->nama_produk == $prg->nama_produk)
                                                    <div class="form-check col-2">
                                                        <input class="form-check-input" type="radio" name="size_order" value="{{$prd->size}}" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">{{$prd->size}}</label>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- pilih ukuran dan jenis sablon -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Pilih sablon</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select name="sablon_id" id="test hargasablon" onchange="showDiv('hidden_div',this)" class="form-select" aria-label=".form-select-sm example">
                                                        <option selected>pilih ukuran sablon</option>
                                                        @foreach($sablon as $sab)
                                                        <option value="{{$sab->sablon_id}}" data-harga_sablon="{{$sab->harga}}">{{$sab->ukuran_sablon}}, Rp.{{$sab->harga}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="hidden_div">
                                                <div class="input-group mt-2">
                                                    <div class="col-lg-2 col-sm-5 col-md-4">
                                                        <h6>Upload desain 1</h6>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-7 col-md-8">
                                                        <input type="file" class="form-control" name="desain1">
                                                    </div>
                                                </div>
                                                <div class="input-group mt-2">
                                                    <div class="col-lg-2 col-sm-5 col-md-4">
                                                        <h6>Upload desai 2</h6>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-7 col-md-8">
                                                        <input type="file" class="form-control" name="desain2">
                                                    </div>
                                                </div>
                                                <div class="input-group mt-2">
                                                    <div class="col-lg-2 col-sm-5 col-md-4">
                                                        <h6>Upload desain 3</h6>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-7 col-md-8">
                                                        <input type="file" class="form-control" name="desain3">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- input kurir id -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jasa kirim</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select name="kurir_id" class="form-select" aria-label="Default select example">
                                                        <option selected>pilih jasa kirim</option>
                                                        @foreach($jakir as $vals)
                                                        <option value="{{$vals->kurir_id}}">{{$vals->nama_jakir}},{{$vals->jenis_jakir}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- input id metode pembayaran -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Metode pembayaran</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select name="payment_id" class="form-select" aria-label="Default select example">
                                                        <option selected>pilih metode</option>
                                                        @foreach($payment as $pay)
                                                        <option value="{{$pay->payment_id}}">{{$pay->pay_method}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- input jumlah order -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jumlah order</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <input type="number" id="jml" name="jml_order" class="form-control">
                                                </div>
                                            </div>
                                            <!-- input pesan -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Tinggalkan pesan</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <input type="text" name="t_pesan" class="form-control" placeholder="tinggalkan pesan untuk produk atau desain">
                                                </div>
                                            </div>
                                            <!-- input tanggal order -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Tanggal order</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <input type="hidden" name="tgl_order" value="{{date('Y/m/d')}}" class="form-control">
                                                </div>
                                            </div>
                                            <!-- total produk -->
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Total produk</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <div class="form-group mb-0">
                                                        <input type="text" id="total" class="form-control" placeholder="Total" readonly />
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
                        <!-- Button update modal -->
                        <div class="mb-2 mt-4 col-3 mx-auto d-flex justify-content-between">
                            <button type="submit" class="btn btn-success">Checkout</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keranjang</button>
                        </div>
                    </form>
                </div>
                <!-- </form> -->
            </div>
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
            // console.log(total, harga_juals)
            $("#total").val(total); //return value total to input total
        });
        DataCustom()
    });

    // function show and hidden element after select sablon
    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value >= 2 ? 'block' : 'none'; //condition ternary for show and hidden element
    }

    function DataCustom() {
        $.ajax({
            method: "GET",
            url: '/pilihbaju/{{$id}}',
            dataType: "json",
            success: function(datas) {
                $.each(datas.produks, function(key, row) {
                    $('#featured-dep' + (key + 1)).click(function() {
                        $('.main-image').attr('src', '/foto_produk/' + row.foto_dep);
                    })
                    // $('#featured-bel' + (key + 1)).click(function() {
                    //     $('.main-image').attr('src', '/foto_produk/' + row.foto_bel);
                    // })
                })
                $.each(datas.produks, function(number, row) {
                    $('#featured-bel' + (number + 1)).click(function() {
                        $('.main-image').attr('src', '/foto_produk/' + row.foto_bel);
                    })
                })
            }
        });

    }
</script>
@endsection
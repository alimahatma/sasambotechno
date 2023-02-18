@include('layout.header')
<div class="content" id="datamains" data-loading="true">
    <div class="mt-5 col-lg-10 col-md-11 col-sm-12 mx-auto">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- <div class="form"> -->
                    <form action="/pesanan/addpesanan" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
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
                            <div class="row row-cols-1 row-cols-md-2 g-4">
                                <div class="col-lg-3 col-md-4 col-sm-4">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($procus as $prd)
                                            @foreach($prdkgroup as $prg)
                                            @if($prd->ktgr_procus_id == $id)
                                            @if($prd->nama_produk == $prg->nama_produk)
                                            <div class="carousel-item active">
                                                <img src="/foto_produk/{{$prd->foto_dep}}" class="d-block w-100" height="400px" alt="404">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="/foto_produk/{{$prd->foto_bel}}" class="d-block w-100" height="400px" alt="404">
                                            </div>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8 col-sm-8">
                                    <div class="shadow-none">
                                        <div class="card-body">
                                            <div class="col">
                                                @foreach($kategori_produk_custom as $row)
                                                @foreach($produkcustoms as $prdklimit)
                                                @if(($row->ktgr_procus_id == $id) && ($prdklimit->ktgr_procus_id == $row->ktgr_procus_id))
                                                <h5 class="card-title color__green">{{$prdklimit->nama_produk}}</h5>
                                                <h6 class="card-title color__green">Rp. {{$prdklimit->harga_jual}}</h6>
                                                <input type="hidden" name="procus_id" value="{{$prdklimit->procus_id}}">
                                                <input type="hidden" value="{{$prdklimit->harga_jual}}" id="harga_jual"> <!--mengambil harga barang menngunakan input-->
                                                @endif
                                                @endforeach
                                                @endforeach
                                                <p class="text text-success">silahkan login terlebih dahulu untuk melakukan transaksi</p>
                                            </div>
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jenis kain</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <p class="card-text">: {{$prd->jenis_kain}}</p>
                                                </div>
                                            </div>
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Pilih warna</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>pilih warna</option>
                                                        @foreach($colors as $col)
                                                        @foreach($procolor as $prclr)
                                                        @if($prclr->ktgr_procus_id == $id && $prclr->nama_warna == $col->nama_warna)
                                                        <option value="{{$prd->warna_id}}">
                                                            {{$prclr->warna_id}},{{$prclr->nama_warna}}
                                                        </option>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                                                        <input class="form-check-input" type="radio" name="size" value="{{$prd->size}}" id="flexRadioDefault1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            {{$prd->size}}
                                                        </label>
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jumlah order</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <input type="number" id="jml" name="jml" class="form-control">
                                                </div>
                                            </div>
                                            <div class="input-group mt-2">
                                                <div class="col-lg-2 col-sm-5 col-md-4">
                                                    <h6>Jasa kirim</h6>
                                                </div>
                                                <div class="col-lg-3 col-sm-7 col-md-8">
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>pilih jasa kirim</option>
                                                        @foreach($jakir as $vals)
                                                        <option value="{{$vals->kurir_id}}">{{$vals->nama_jakir}},{{$vals->jenis_jakir}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="mt-3">
                                        <h6>Deskripsi : </h6>
                                        <p class="card-text style__font">{{$prd->deskripsi}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button update modal -->
                        <div class="mb-2 mt-4 col-3 mx-auto d-flex justify-content-between">
                            <a href="/" class="btn btn-danger">Kembali</a>
                            <!-- <button type="submit" class="btn btn-success">
                                Checkout
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal">
                                <span><ion-icon name="cart-outline"></ion-icon></span>
                                Add to cart
                            </button> -->
                        </div>
                    </form>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // function count total harga
    $(document).ready(function() {
        $("#jml, #harga_jual").keyup(function() {
            var harga_juals = $("#harga_jual").val(); //get value from input id harga jual
            var jmls = $("#jml").val(); //get jumlah order from input order

            var total = harga_juals * jmls; //count harga jual and jumlah harga
            // console.log(total, harga_juals)
            $("#total").val(total); //return value total to input total

        });
    });

    // function show and hidden element after select sablon
    function showDiv(divId, element) {
        document.getElementById(divId).style.display = element.value >= 2 ? 'block' : 'none'; //condition ternary for show and hidden element
    }
</script>
@include('layout.footer')
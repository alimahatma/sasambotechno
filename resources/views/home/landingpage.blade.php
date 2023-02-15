@include('layout.header')
<div class="container">
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach($ktgrproduk as $ktgr)
            <div class="carousel-item active">
                <img src="/foto_ktgr/{{$ktgr->foto_ktgr}}" class="d-block w-100" alt="404">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{$ktgr->jenis_kategori}}</h5>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end carousel -->

    <!-- visi dan misi -->
    <div class="row mt-5">
        @foreach($instansi as $inst)
        <div class="col-md-5 col-lg-6 col-sm-4">
            <div class="page-header">
                <h6 class="mx-auto">
                    Visi
                </h6>
                <p class="style__font">{{$inst->visi}}</p>
            </div>
        </div>
        <div class="col-md-5 col-lg-6 col-sm-4">
            <div class="page-header">
                <h6 class="mx-auto">
                    Misi
                </h6>
                <p class="style__font">{{$inst->misi}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <!-- end visi dan misi -->

    <!-- pelayanan -->
    <div class="row mt-5">
        <div class="page-header">
            <div class="col-md-6 col-lg-5 col-sm-6 mx-auto text-center">
                <h6 class="color__green">PELAYANAN KAMI</h6>
                <p>sasambo techno merupakan jasa sablon dan jasa software terbaik di lombok</p>
            </div>
        </div>

        <!-- kategori software -->
        <div class="row justify-content-between p-3">
            <div class="page-header mb-3">
                <div class="col-md-6 col-lg-5 col-sm-6 mx-auto text-center">
                    <h6 class="color__green">PRODUK SOFTWARE</h6>
                </div>
            </div>
            @foreach($ktgrprosoft as $row)
            <div class="card-body mb-5">
                <div class="row g-0">
                    <div class="col-md-4 col-lg-6">
                        <img src="/foto_ktgr/{{$row->foto_prosoft}}" class="img-fluid rounded-start" alt="404" style=" max-width: 440px;">
                    </div>
                    <div class="col-md-8 col-lg-6">
                        <div class="card-body">
                            <h5 class="card-title mt-3">{{$row->jenis_prosoft}}</h5>
                            <p class="card-text style__font">{{$row->des_ktgrprosoft}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- kategori custom -->
        <div class="row justify-content-between p-3">
            <div class="page-header mb-3">
                <div class="col-md-6 col-lg-5 col-sm-6 mx-auto text-center">
                    <h6 class="color__green">PRODUK CUSTOM</h6>
                </div>
            </div>
            @foreach($ktgrprocus as $row)
            <div class="card-body mb-5">
                <div class="row g-0">
                    <div class="col-md-8 col-lg-6">
                        <div class="card-body">
                            <h5 class="card-title mt-3">{{$row->jenis_procus}}</h5>
                            <p class="card-text style__font">{{$row->des_ktgrprocus}}</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-6">
                        <img src="/foto_ktgr/{{$row->foto_procus}}" class="img-fluid rounded-start" alt="404" style="max-width: 440px;">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@include('layout.footer')
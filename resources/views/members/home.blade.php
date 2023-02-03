<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="shortcut icon" href="{{asset('assetsaja')}}/assets/images/logo/favicon.ico" type="image/x-icon"> -->

    <!-- custom css link -->
    <link rel="stylesheet" href="{{asset('assetsaja')}}/css/style-prefix.css">

    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="product-container">
        <div class="container">
            <div class="product-box">

                <!-- produk grid -->
                <div class="product-main">
                    <h2 class="title" style="text-align: center; margin-top: 2rem; color:#40883C;">Kategori produk custom</h2>
                    <div class="product-grid">
                        @foreach($kategoricustom as $ktgr)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/pilihbaju">
                                    <img src="/foto_ktgr/{{$ktgr->foto_procus}}" alt="404" class="product-img default">
                                    <img src="/foto_ktgr/{{$ktgr->foto_procus}}" alt="404" class="product-img hover">
                                </a>
                            </div>
                            <div class="showcase-content">
                                <a href="/pilihbaju" class="showcase-category" style="color:#40883C;">{{$ktgr->jenis_procus}}</a>
                                <div class="showcase-rating">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- end produk grid -->

                <!-- produk grid -->
                <div class="product-main">
                    @foreach($kategoricustom as $ktgr)
                    <div class="title" style="text-align: center; margin-top: 2rem; color: #40883C">{{$ktgr->jenis_procus}}</div>
                    <div class="product-grid">
                        @foreach($procus as $pro)
                        @if($ktgr->ktgr_procus_id == $pro->ktgr_procus_id)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/pilihbaju">
                                    <img src="/foto_produk/{{$pro->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$pro->foto_bel}}" alt="404" class="product-img hover">
                                </a>
                            </div>
                            <div class="showcase-content">
                                <p class="showcase-title" style="color: #40883C;">{{$pro->nama_produk}}</p>
                                <del class="showcase-title">Rp. {{$pro->harga_jual}}</del>
                                <p class="price" style="color: #40883C;">Rp. {{$pro->harga_jual}}</p>
                                <div class="showcase-rating">
                                </div>
                            </div>
                        </div>
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/pilihbaju">
                                    <img src="/foto_produk/{{$pro->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$pro->foto_bel}}" alt="404" class="product-img hover">
                                </a>
                            </div>
                            <div class="showcase-content">
                                <p class="showcase-title" style="color: #40883C;">{{$pro->nama_produk}}</p>
                                <del class="showcase-title">Rp. {{$pro->harga_jual}}</del>
                                <p class="price" style="color: #40883C;">Rp. {{$pro->harga_jual}}</p>
                                <div class="showcase-rating">
                                </div>
                            </div>
                        </div>
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/pilihbaju">
                                    <img src="/foto_produk/{{$pro->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$pro->foto_bel}}" alt="404" class="product-img hover">
                                </a>
                            </div>
                            <div class="showcase-content">
                                <p class="showcase-title" style="color: #40883C;">{{$pro->nama_produk}}</p>
                                <del class="showcase-title">Rp. {{$pro->harga_jual}}</del>
                                <p class="price" style="color: #40883C;">Rp. {{$pro->harga_jual}}</p>
                                <div class="showcase-rating">
                                </div>
                            </div>
                        </div>
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/pilihbaju">
                                    <img src="/foto_produk/{{$pro->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$pro->foto_bel}}" alt="404" class="product-img hover">
                                </a>
                            </div>
                            <div class="showcase-content">
                                <p class="showcase-title" style="color: #40883C;">{{$pro->nama_produk}}</p>
                                <del class="showcase-title">Rp. {{$pro->harga_jual}}</del>
                                <p class="price" style="color: #40883C;">Rp. {{$pro->harga_jual}}</p>
                                <div class="showcase-rating">
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                <!-- end produk grid -->
            </div>
        </div>
    </div>

    <!-- link assets js -->
    <script src="{{asset('assetsaja')}}/assets/js/script.js"></script>

    <!-- link for ionicon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
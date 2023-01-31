<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="shortcut icon" href="{{asset('assetsaja')}}/assets/images/logo/favicon.ico" type="image/x-icon">

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
                    <h2 class="title">Kategori produk</h2>
                    <div class="product-grid">
                        @foreach($kategori as $ktgr)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/login">
                                    <!-- <img src="{{asset('assetsaja')}}/images/products/jacket-3.jpg" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
                                    <img src="{{asset('assetsaja')}}/images/products/jacket-4.jpg" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover"> -->
                                    <img src="/foto_produk/{{$ktgr->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$ktgr->foto_dep}}" alt="404" class="product-img hover">
                                    <p class="showcase-badge">1%</p>
                                </a>
                            </div>
                            <div class="showcase-content">
                                <a href="#" class="showcase-category">{{$ktgr->nama_produk}}</a>
                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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
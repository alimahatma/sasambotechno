<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="shortcut icon" href="{{asset('assetsaja')}}/assets/images/logo/favicon.ico" type="image/x-icon">

    <!--
  - custom css link
-->
    <link rel="stylesheet" href="{{asset('assetsaja')}}/css/style-prefix.css">

    <!--
  - google font link
-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>



    <div class="product-container">

        <div class="container">
            <div class="product-box">
                <!--
                - PRODUCT GRID
              -->

                <div class="product-main">

                    <h2 class="title">New Products</h2>

                    <div class="product-grid">
                        @foreach($produks as $prdk)
                        <div class="showcase">
                            <div class="showcase-banner">
                                <a href="/login">
                                    <!-- <img src="{{asset('assetsaja')}}/images/products/jacket-3.jpg" alt="Mens Winter Leathers Jackets" width="300" class="product-img default">
                                    <img src="{{asset('assetsaja')}}/images/products/jacket-4.jpg" alt="Mens Winter Leathers Jackets" width="300" class="product-img hover"> -->
                                    <img src="/foto_produk/{{$prdk->foto_dep}}" alt="404" class="product-img default">
                                    <img src="/foto_produk/{{$prdk->foto_dep}}" alt="404" class="product-img hover">
                                    <p class="showcase-badge">15%</p>
                                    <!-- <div class="showcase-actions">

                                        <button class="btn-action">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button>

                                        <button class="btn-action">
                                            <ion-icon name="eye-outline"></ion-icon>
                                        </button>

                                        <button class="btn-action">
                                            <ion-icon name="repeat-outline"></ion-icon>
                                        </button>

                                        <button class="btn-action">
                                            <ion-icon name="bag-add-outline"></ion-icon>
                                        </button>

                                    </div> -->
                                </a>
                            </div>
                            <div class="showcase-content">
                                <a href="#" class="showcase-category">{{$prdk->nama_produk}}</a>
                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <!-- <ion-icon name="star-outline"></ion-icon> -->
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="showcase">

                            <div class="showcase-banner">
                                <img src="{{asset('assetsaja')}}/images/products/shirt-1.jpg" alt="Pure Garment Dyed Cotton Shirt" class="product-img default" width="300">
                                <img src="{{asset('assetsaja')}}/images/products/shirt-2.jpg" alt="Pure Garment Dyed Cotton Shirt" class="product-img hover" width="300">

                                <p class="showcase-badge angle black">sale</p>

                                <div class="showcase-actions">
                                    <button class="btn-action">
                                        <ion-icon name="heart-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="repeat-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="bag-add-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>

                            <div class="showcase-content">
                                <a href="#" class="showcase-category">shirt</a>

                                <h3>
                                    <a href="#" class="showcase-title">Pure Garment Dyed Cotton Shirt</a>
                                </h3>

                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </div>

                                <div class="price-box">
                                    <p class="price">$45.00</p>
                                    <del>$56.00</del>
                                </div>

                            </div>

                        </div>

                        <div class="showcase">

                            <div class="showcase-banner">
                                <img src="{{asset('assetsaja')}}/images/products/jacket-5.jpg" alt="MEN Yarn Fleece Full-Zip Jacket" class="product-img default" width="300">
                                <img src="{{asset('assetsaja')}}/images/products/jacket-6.jpg" alt="MEN Yarn Fleece Full-Zip Jacket" class="product-img hover" width="300">

                                <div class="showcase-actions">
                                    <button class="btn-action">
                                        <ion-icon name="heart-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="repeat-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="bag-add-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>

                            <div class="showcase-content">
                                <a href="#" class="showcase-category">Jacket</a>

                                <h3>
                                    <a href="#" class="showcase-title">MEN Yarn Fleece Full-Zip Jacket</a>
                                </h3>

                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                    <ion-icon name="star-outline"></ion-icon>
                                </div>

                                <div class="price-box">
                                    <p class="price">$58.00</p>
                                    <del>$65.00</del>
                                </div>

                            </div>

                        </div>

                        <div class="showcase">

                            <div class="showcase-banner">
                                <img src="{{asset('assetsaja')}}/images/products/clothes-3.jpg" alt="Black Floral Wrap Midi Skirt" class="product-img default" width="300">
                                <img src="{{asset('assetsaja')}}/images/products/clothes-4.jpg" alt="Black Floral Wrap Midi Skirt" class="product-img hover" width="300">

                                <p class="showcase-badge angle pink">new</p>

                                <div class="showcase-actions">
                                    <button class="btn-action">
                                        <ion-icon name="heart-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="eye-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="repeat-outline"></ion-icon>
                                    </button>

                                    <button class="btn-action">
                                        <ion-icon name="bag-add-outline"></ion-icon>
                                    </button>
                                </div>
                            </div>

                            <div class="showcase-content">
                                <a href="#" class="showcase-category">skirt</a>

                                <h3>
                                    <a href="#" class="showcase-title">Black Floral Wrap Midi Skirt</a>
                                </h3>

                                <div class="showcase-rating">
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                    <ion-icon name="star"></ion-icon>
                                </div>

                                <div class="price-box">
                                    <p class="price">$25.00</p>
                                    <del>$35.00</del>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assetsaja')}}/assets/js/script.js"></script>

    <!--
  - ionicon link
-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
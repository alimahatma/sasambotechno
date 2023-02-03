<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">


    <!-- link for template produk -->
    <link rel="stylesheet" href="{{asset('assetsaja')}}/css/style-prefix.css">
    <!-- <link rel="stylesheet" href="{{asset('assetsaja')}}/css/style.css"> -->

    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- end link tempalte produk -->

    <style>
        .nolist {
            list-style-type: none;
        }

        .__spaces {
            margin-right: 8px;
        }

        .style__font {
            text-align: justify;
        }

        .size__font {
            font-size: 16px;
        }

        .color-teks {
            color: #FFF;
            text-decoration: none;
        }

        .color__green {
            color: #0FAA5D;
        }
    </style>
    <title>{{$title ?? ""}}</title>
</head>

<body>
    <header style="background-color: #0FAA5D;">
        <nav class="desktop-navigation-menu">
            <div class="container">
                <ul class="desktop-menu-category-list">
                    <li class="menu-category">
                        <a href="#" class="header-logo">
                            <!-- <img src="./assets/images/logo/logo.svg" alt="Anon's logo" width="120" height="36"> -->
                            @foreach($instansi as $inst)
                            <img src="/logo/{{$inst->logo}}" alt="Logo" width="60" height="35" class="d-inline-block align-text-top">
                            @endforeach
                        </a>
                    </li>
                    <li class="menu-category">
                        <a href="/" class="menu-title">Home</a>
                    </li>
                    <li class="menu-category">
                        <a href="#" class="menu-title">Produk</a>

                        <ul class="dropdown-list">

                            <li class="dropdown-item">
                                <a href="#">Software</a>
                            </li>

                            <li class="dropdown-item">
                                <a href="produk">Pakaian custom</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-category">
                        <a href="tutorial" class="menu-title">Tutorial</a>
                    </li>
                    <li class="menu-category">
                        <a href="video" class="menu-title">Video</a>
                    </li>
                    <li class="menu-category">
                        <a href="contact" class="menu-title">Contact</a>
                    </li>
                    <li class="menu-category">
                        <a href="#" class="menu-title">Login / Register</a>
                        <ul class="dropdown-list">
                            <li class="dropdown-item">
                                <a href="login">Login</a>
                            </li>
                            <li class="dropdown-item">
                                <a href="register">Register</a>
                            </li>
                        </ul>
                    </li>
                    <div class="header-user-actions">

                        <button class="action-btn">
                            <ion-icon name="person-outline"></ion-icon>
                        </button>

                        <button class="action-btn">
                            <ion-icon name="heart-outline"></ion-icon>
                            <span class="count">0</span>
                        </button>

                        <button class="action-btn">
                            <ion-icon name="bag-handle-outline"></ion-icon>
                            <span class="count">0</span>
                        </button>

                    </div>
                </ul>
            </div>
        </nav>
    </header>

    <!-- <nav class="navbar" style="background-color: #40883C;">
        <div class="container-fluid">
            <div class="col-8">
            </div>
            <div class="navbar-brand">
                <a class="navbar-brand" style="color: #FFF;" href="#">NEWSLETTER</a>
                <a class="navbar-brand" style="color: #FFF;" href="#">CONTACT US</a>
                <a class="navbar-brand" style="color: #FFF;" href="#">FAQs</a>
            </div>
        </div>
    </nav>
    <nav class="navbar  navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                @foreach($instansi as $inst)
                <img src="/logo/{{$inst->logo}}" alt="Logo" width="60" height="35" class="d-inline-block align-text-top">
                @endforeach
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #40883C;" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #40883C;" aria-current="page" href="produk">PRODUK</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #40883C;" aria-current="page" href="tutorial">TUTORIAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #40883C;" aria-current="page" href="video">VIDEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color: #40883C;" aria-current="page" href="contact">ABOUT ME</a>
                    </li>
                </ul>
            </div>
            <div class="navbar-brand">
                <a class="navbar-brand" style="color: #40883C;" href="login">LOGIN / </a>
                <a class="navbar-brand" style="color: #40883C;" href="register">REGISTER</a>
            </div>
        </div>
    </nav> -->
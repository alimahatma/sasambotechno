<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- link load assets bootstrap -->
    <link rel="stylesheet" href="{{asset('assetsaja')}}/css/bootstrap.min.css">

    <!--google font link-->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->


    <!-- load jquery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <style>
        #hidden_div {
            display: none;
        }

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
            color: #FFFFFF;
            text-decoration: none;
        }

        .color__green {
            color: #0FAA5D;
        }

        .text__nodecoration {
            text-decoration: none;
        }
    </style>
    <title>{{$title ?? ""}}</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0FAA5D;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                @foreach($instansi as $inst)
                <img src="/logo/{{$inst->logo}}" alt="Logo" width="60" height="35" class="d-inline-block align-text-top">
                @endforeach
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#FFFFFF" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color:#FFFFFF" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            PRODUK
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" style="color:#0FAA5D " href="#">Software</a></li>
                            <li><a class="dropdown-item" style="color:#0FAA5D" href="produk">Produk custom</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#FFFFFF" aria-current="page" href="tutorials">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#FFFFFF" aria-current="page" href="videos">VIDEO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#FFFFFF" aria-current="page" href="contact">ABOUT ME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" style="color:#FFFFFF" aria-current="page" href="login">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
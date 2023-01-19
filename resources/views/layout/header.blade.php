<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
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
            color: #40883C;
        }
    </style>
    <title>{{$title ?? ""}}</title>
</head>
<nav class="navbar" style="background-color: #40883C;">
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
                    <a class="nav-link active" style="color: #40883C;" aria-current="page" href="contact">CONTACT US</a>
                </li>
            </ul>
        </div>
        <div class="navbar-brand">
            <a class="navbar-brand" style="color: #40883C;" href="login">LOGIN / </a>
            <a class="navbar-brand" style="color: #40883C;" href="register">REGISTER</a>
        </div>
    </div>
</nav>
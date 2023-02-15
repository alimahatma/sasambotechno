    <!-- footer part start-->
    <footer class="footer-area mt-5 color-teks" style="background-color: #0FAA5D;">
        @foreach($instansi as $row)
        <div class="container py-5">
            <div class="row justify-content-between p-3">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="col">
                        <img src="/logo/{{$row->logo}}" style="height:100px; width:160px" class="card-img-top" alt="404">
                        <div class="card-body">
                            <h4 class="card-title">Alamat</h4>
                            <p class="card-text style__font">{{$row->alamat}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-2">
                    <div class="single-footer-widget footer_2">
                        <h6>RECENT POST</h6>
                        <p class="style__font">Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 col-md-3 col-xl-2">
                    <div class="single-footer-widget footer_2">
                        <h6>OUR PARTNER</h6>
                        <p class="style__font">Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 col-md-3 col-xl-2">
                    <div class="single-footer-widget footer_2">
                        <h6>DOWNLOAD APP</h6>
                        <p class="style__font">Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 col-md-3 col-lg-3">
                    <h6 class="card-title color-teks">FOLLOW ME</h6>
                    <ul class="list-group nolist">
                        <li class="__spaces">
                            <a href="{{$row->domain}}" class="color-teks size__font">
                                <i class="uil uil-server"></i>
                                {{$row->domain}}
                            </a>
                        </li>
                        <li class="__spaces">
                            <a href="{{$row->email}}" class="color-teks size__font">
                                <i class="uil uil-envelope"></i>
                                {{$row->email}}
                            </a>
                        </li>
                        <li class="__spaces">
                            <a href="{{$row->instagram}}" class="color-teks size__font">
                                <i class="uil uil-instagram-alt"></i>
                                {{$row->instagram}}
                            </a>
                        </li>
                        <li class="__spaces">
                            <a href="{{$row->facebook}}" class="color-teks size__font">
                                <i class="uil uil-facebook"></i>
                                {{$row->facebook}}
                            </a>
                        </li>
                        <li class="__spaces">
                            <a href="{{$row->billing}}" class="color-teks size__font">
                                <i class="uil uil-airplay"></i>
                                Billing
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <p class="footer-text m-0">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright sasambotechno &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> Created by PKL 2023
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- load js bootstrap -->
    <script src="{{asset('assetsaja')}}/js/popper.min.js"></script>
    <!-- <script src="{{asset('assetsaja')}}/js/bootstrap.min.js"></script> -->
    <script src="{{asset('assetsaja')}}/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
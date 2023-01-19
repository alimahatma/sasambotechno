@include('layout.header')
<div class="container">
    <!-- carousel -->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner border border-danger">
            <div class="carousel-item active">
                <img src="" class="d-block w-100" alt="404">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="404">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="404">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
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

    <div class="row mt-5">
        <div class="col-md-5 col-lg-6 col-sm-4">
            <div class="page-header">
                <h6 class="mx-auto">
                    Visi
                </h6>
                <p class="style__font">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Inventore aut, iste magni sequi explicabo nemo saepe quod aliquid,
                    earum sit deserunt recusandae asperiores ratione ipsam fugiat veniam. Fugit, esse laboriosam.</p>
            </div>
        </div>
        <div class="col-md-5 col-lg-6 col-sm-4">
            <div class="page-header">
                <h6 class="mx-auto">
                    Misi
                </h6>
                <p class="style__font">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Maiores laborum voluptas dolore molestias pariatur, suscipit rerum,
                    quasi unde quia alias nulla aliquam dignissimos. Unde, tenetur vero officiis nam odit numquam!
                </p>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="page-header">
            <div class="col-md-6 col-lg-5 col-sm-6 mx-auto text-center">
                <h6 class="color__green">KATEGORI PRODUK</h6>
                <p>sasambo techno merupakan jasa sablon dan jasa software terbaik di lombok</p>
            </div>
        </div>
        <div class="row justify-content-between p-3">
            <div class="col-sm-6 col-md-4 col-xl-3 mb-2 border border-primary">
                <div class="col">
                    <div class="card-body">
                        <p class="card-text style__font">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Maiores laborum voluptas dolore molestias pariatur, suscipit rerum,
                            quasi unde quia alias nulla aliquam dignissimos. Unde, tenetur vero officiis nam odit numquam!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 mb-2 border border-primary">
                <div class="col">
                    <div class="card-body">
                        <p class="card-text style__font">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Maiores laborum voluptas dolore molestias pariatur, suscipit rerum,
                            quasi unde quia alias nulla aliquam dignissimos. Unde, tenetur vero officiis nam odit numquam!
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-xl-3 mb-2 border border-primary">
                <div class="col">
                    <div class="card-body">
                        <p class="card-text style__font">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Maiores laborum voluptas dolore molestias pariatur, suscipit rerum,
                            quasi unde quia alias nulla aliquam dignissimos. Unde, tenetur vero officiis nam odit numquam!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
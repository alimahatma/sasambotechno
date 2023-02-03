@extends('layout.template')
@section('content')
<div class="content">
    <div class="card mt-5 col-lg-10 col-md-11 col-sm-12 mx-auto shadow-sm">
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title text-center"></h4>
            </div>
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="form">
                        <form action="pesanan/detailcustom/{$id}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
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
                                @foreach($procus as $prd)
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <div class="col">
                                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="/foto_produk/{{$prd->foto_dep}}" class="d-block w-50" alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="/foto_produk/{{$prd->foto_bel}}" class="d-block w-50" alt="...">
                                                </div>
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
                                    <div class="col">
                                        <div class="card">
                                            <img src="..." class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Button update modal -->
                                <div class="mb-2 col-4 mx-auto">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpdate{{}}">
                                        Checkout
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
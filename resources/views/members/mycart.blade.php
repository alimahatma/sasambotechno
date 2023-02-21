@extends('layout.template')
@section('content')
<div class="card-header">
    <h5 class="text-center mb-3">Testing keranjang</h5>
</div>

<!-- lihat data produk yang ada di dalam keranjang anda -->
<div class="card shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                </div>
            </div>
            <div class="col">
                <p><img src="/foto_produk/depan/" alt="404"></p>
            </div>
            <div class="col">
                <p>Nama produk</p>
            </div>
            <div class="col">
                <p>Warna</p>
            </div>
            <div class="col">
                <p>Ukuran</p>
            </div>
            <div class="col">
                <p>Jumlah order</p>
            </div>
            <div class="col">
                <p>Harga Satuan</p>
            </div>
            <div class="col">
                <p>Total produk</p>
            </div>
            <div class="col">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSingle"><i class="fas fa-trash"></i></button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutSingle">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- tombol checkout semua data produk yang ada di dalam keranjang anda -->
<div>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMulti"><i class="fas fa-trash"></i></button>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutMulti">Checkout</button>
    </div>
</div>

<!-- notifification if cart on null -->
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-4 mx-auto">
        <p class="text-text success text-center">keranjang belanja anda kosong</p>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-outline-success" href="/home">
                <i class="fas fa-cart-plus"></i>
                Belanja sekarang
            </a>
        </div>
    </div>
</div>

<!-- checkout single -->
<div class="modal modal-lg" id="checkoutSingle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <input type="hidden" name="{{Auth::user()->user_id}}" class="form-control" id="exampleFormControlInput1">
                    <input type="hidden" name="" class="form-control" id="exampleFormControlInput1">
                    <div class="mb-3">
                        <h6>Pilih jasa kirim</h6>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>pilih jasa kirim</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <h6>Metode Pembayaran</h6>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>pilih metode pembayaran</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tinggalkan pesan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end checkout single -->

<!-- checkout multiple -->
<div class="modal modal-lg" id="checkoutMulti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    <input type="hidden" name="{{Auth::user()->user_id}}" class="form-control" id="exampleFormControlInput1">
                    <input type="hidden" name="" class="form-control" id="exampleFormControlInput1">
                    <div class="mb-3">
                        <h6>Pilih jasa kirim</h6>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>pilih jasa kirim</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <h6>Metode Pembayaran</h6>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>pilih metode pembayaran</option>
                            <option value="1">One</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tinggalkan pesan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end checkout multiple -->


<!-- delete single produk -->
<div class="modal modal-lg" id="deleteSingle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus {{"nama barang"}} barang di keranjang anda...?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Pesan</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete single produk -->

<!-- delete multiple produks -->
<div class="modal modal-lg" id="deleteMulti" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus semua barang di keranjang anda...?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Pesan</button>
            </div>
        </div>
    </div>
</div>
<!-- end delete multiple produks -->
@endsection
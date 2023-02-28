@extends('layout.template')
@section('content')
<div class="card-header">
    <h5 class="text-center mb-3">Keranjang belanja saya</h5>
</div>

<!-- alert success or errors-->
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
<!-- end alert success or errors -->

<!-- lihat data produk yang ada di dalam keranjang anda -->
@foreach($shopcartproduk as $row)
@if(Auth::user()->user_id == $row->user_id)
<form action="/" method="post">
    @csrf
    <!-- jika id produk custom tidak kosong -->
    @if($row->procus_id != NULL)
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="procus_id[]" value="{{$row->procus_id}}" id="flexCheckDefault">
                    </div>
                </div>
                <div class="col">
                    <img src="/foto_produk/depan/{{$row->foto_dep}}" width="100px" height="130px" alt="404">
                </div>
                <div class="col">
                    <p>{{$row->nama_produk}}</p>
                </div>
                <div class="col">
                    <p>{{$row->nama_warna}}</p>
                </div>
                <div class="col">
                    <p>{{$row->size}}</p>
                </div>
                <div class="col-1 d-flex justify-content-between">
                    <div class="col-2">
                        <p class="mt-1">X</p>
                    </div>
                    <div class="col-8">
                        <input type="number" id="jumlah_order_pakaian" name="jumlah_order" value="{{$row->jumlah_order}}" onchange="jmlOrderPakaian()" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col">
                    <p>Rp. {{$row->harga_satuan}} / {{$row->satuan}}</p>
                </div>
                <div class="col" id="harga_satuan_pakaian" data-pakaian="{{$row->harga_satuan}}">
                </div>
                <div class="col">
                    <p id="harga_total_pakaian"></p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- jika sablon id tidak kosong -->
    @if($row->sablon_id != NULL)
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sablon_id[]" value="{{$row->sablon_id}}" id="flexCheckDefault">
                    </div>
                </div>
                <div class="col">
                    <p>Size : {{$row->ukuran_sablon}}</p>
                </div>
                <div class="col-1 d-flex justify-content-between">
                    <div class="col-2">
                        <p class="mt-1">X</p>
                    </div>
                    <div class="col-8">
                        <input type="number" id="jumlah_order_sablon" name="jumlah_order" value="{{$row->jumlah_order}}" onchange="jmlOrder()" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col">
                    <p>Rp. {{$row->harga}}</p>
                </div>
                <div class="col" id="harga_satuan_sablon" data-harga="{{$row->harga}}">
                </div>
                <div class="col">
                    <p id="harga_total_sablon"></p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @elseif(Auth::user()->user_id != $row->user_id)
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
    @endif

    @endforeach
    <!-- end view read data pesanan sablon yang ada di dalam keranjang anda -->

    <!-- tombol checkout semua data produk yang ada di dalam keranjang anda -->
    <div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMulti"><i class="fas fa-trash"></i></button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#checkoutMulti">Checkout</button>
        </div>
    </div>
    <!-- end tombol checkout semua data produk yang ada di dalam keranjang anda -->
</form>

@foreach($shopcartproduk as $val)
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
@endforeach

<script>
    // code pakaian custom
    let gethargaPakaian = document.getElementById('harga_satuan_pakaian').getAttribute('data-pakaian');
    let getJumlahOrderPakaian = document.getElementById('jumlah_order_pakaian').value;
    document.getElementById('harga_total_pakaian').innerHTML = "Rp. " + gethargaPakaian * getJumlahOrderPakaian;

    function jmlOrderPakaian() {
        let getJumlahOrderPakaian = document.getElementById('jumlah_order_pakaian').value;
        let gethargaSatuanPakaian = document.getElementById('harga_satuan_pakaian').getAttribute('data-pakaian');
        let TotalHargaPakaian = getJumlahOrderPakaian * gethargaSatuanPakaian;
        document.getElementById('harga_total_pakaian').innerHTML = "Rp. " + TotalHargaPakaian;
    }

    let getharga = document.getElementById('harga_satuan_sablon').getAttribute('data-harga');
    let getJumlahOrderSablon = document.getElementById('jumlah_order_sablon').value;
    document.getElementById('harga_total_sablon').innerHTML = "Rp. " + getharga * getJumlahOrderSablon;

    function jmlOrder() {
        let getJumlahOrderSablon = document.getElementById('jumlah_order_sablon').value;
        let gethargaSatuanSablon = document.getElementById('harga_satuan_sablon').getAttribute('data-harga');
        // console.log(gethargaSatuanSablon);
        let TotalHargaSablon = getJumlahOrderSablon * gethargaSatuanSablon;
        document.getElementById('harga_total_sablon').innerHTML = "Rp. " + TotalHargaSablon;
    }
</script>
@endsection
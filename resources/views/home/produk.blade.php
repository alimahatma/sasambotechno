@include('layout.header')
<div class="container">

    <div class="row row-cols-1 row-cols-md-6 g-4 mt-2">
        @foreach($kategoricustom as $ktgr)
        <div class="col">
            <div class="card h-100">
                <a href="detailcustom/{{$ktgr->ktgr_procus_id}}">
                    <img src="/foto_ktgr/{{$ktgr->foto_procus}}" class="card-img-top" alt="404">
                    <div class="card-body">
                        <a href="detailcustom/{{$ktgr->ktgr_procus_id}}" class="text__nodecoration color__green">{{$ktgr->jenis_procus}}</a>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-4 mt-2">
        @foreach($procus as $pro)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <a id="{{$pro->procus_id}}" href="/detailcustom/{{$pro->procus_id}}">
                    <img src="/foto_produk/depan/{{$pro->foto_dep}}" class="card-img-top mt-3" alt="404">
                    <div class="card-body">
                        <a href="/detailcustom/{{$pro->procus_id}}" class="text__nodecoration color__green">{{$pro->nama_produk}}</a>
                        <br>
                        <del style="font-size: 12px;">Rp. {{$pro->harga_jual}}</del>
                        <h6 style="color: #0FAA5D;">Rp. {{$pro->harga_jual}}</h6>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layout.footer')
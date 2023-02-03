@include('layout.header')
<div class="product-container">
    <div class="container">
        <div class="product-box">

            <!-- produk grid -->
            <div class="product-main">
                <h2 class="title" style="text-align: center; margin-top: 2rem; color:#0FAA5D;">Kategori produk custom</h2>
                <div class="product-grid">
                    @foreach($kategoricustom as $ktgr)
                    <div class="showcase">
                        <div class="showcase-banner">
                            <a href="pesanan/detailcustom/{{$ktgr->ktgr_procus_id}}">
                                <img src="/foto_ktgr/{{$ktgr->foto_procus}}" alt="404" class="product-img default">
                                <img src="/foto_ktgr/{{$ktgr->foto_procus}}" alt="404" class="product-img hover">
                            </a>
                        </div>
                        <div class="showcase-content">
                            <a href="pesanan/detailcustom/{{$ktgr->ktgr_procus_id}}" class="showcase-category" style="color:#0FAA5D;">{{$ktgr->jenis_procus}}</a>
                            <div class="showcase-rating">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- end produk grid -->

            <!-- produk grid -->
            <div class="product-main">
                @foreach($kategoricustom as $ktgr)
                <div class="title" style="text-align: center; margin-top: 2rem; color: #0FAA5D">{{$ktgr->jenis_procus}}</div>
                <div class="product-grid">
                    @foreach($procus as $pro)
                    @if($ktgr->ktgr_procus_id == $pro->ktgr_procus_id)
                    <div class="showcase">
                        <div class="showcase-banner">
                            <a href="pesanan/detailcustom/{{$ktgr->ktgr_procus_id}}">
                                <img src="/foto_produk/{{$pro->foto_dep}}" alt="404" class="product-img default">
                                <img src="/foto_produk/{{$pro->foto_bel}}" alt="404" class="product-img hover">
                            </a>
                        </div>
                        <div class="showcase-content">
                            <p class="showcase-title" style="color: #0FAA5D;">{{$pro->nama_produk}}</p>
                            <del class="showcase-title">Rp. {{$pro->harga_jual}}</del>
                            <p class="price" style="color: #0FAA5D;">Rp. {{$pro->harga_jual}}</p>
                            <div class="showcase-rating">
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endforeach
            </div>
            <!-- end produk grid -->
        </div>
    </div>
</div>
@include('layout.footer')
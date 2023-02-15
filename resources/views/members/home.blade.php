@extends('layout.template')
@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-6 g-4 mt-2">
        @foreach($kategoricustom as $ktgr)
        <div class="col">
            <div class="card h-100">
                <a href="/selectcloth/{{$ktgr->ktgr_procus_id}}">
                    <img src="/foto_ktgr/{{$ktgr->foto_procus}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <a href="/selectcloth/{{$ktgr->ktgr_procus_id}}" class="text__nodecoration color__green">{{$ktgr->jenis_procus}}</a>
                        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row row-cols-1 row-cols-md-6 g-4 mt-2">
        @foreach($kategoricustom as $ktgr)
        @foreach($procus as $pro)
        @if($ktgr->ktgr_procus_id == $pro->ktgr_procus_id)
        <div class="col">
            <div class="card h-100">
                <a href="/selectcloth/{{$ktgr->ktgr_procus_id}}">
                    <img src="/foto_produk/{{$pro->foto_dep}}" class="card-img-top" alt="404">
                    <div class="card-body">
                        <a href="/selectcloth/{{$ktgr->ktgr_procus_id}}" class="text__nodecoration color__green">{{$pro->nama_produk}}</a>
                        <br>
                        <del style="font-size: 12px;">Rp. {{$pro->harga_jual}}</del>
                        <h6 style="color: #0FAA5D;">Rp. {{$pro->harga_jual}}</h6>
                    </div>
                </a>
            </div>
        </div>
        @endif
        @endforeach
        @endforeach
    </div>
</div>
@endsection
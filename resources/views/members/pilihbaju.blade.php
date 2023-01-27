@extends('layout.template')
@section('content')
<div class="page-heading">
    <p class="text-subtitle text-muted">Selamat datang {{Auth::user()->name}}</p>
</div>
<h2>testing halaman pilih baju</h2>
@endsection
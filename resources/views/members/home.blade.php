@extends('layout.template')
@section('content')
<div class="page-heading">
    <h3>{{$title}}</h3>
    <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->name}}</p>
</div>
<h2>Halaman member</h2>
@endsection
@extends('layout.template')
@section('content')
<div class="content">
    <div class="card-header">
        <h4 class="card-title text-center">List sablon</h4>
    </div>
    <div class="mt-5 col-lg-12 col-md-12 mx-auto">
        <div class="card-body">
            <div class="row">
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
                @foreach($sablon as $sab)
                @if($sab->harga!=0)
                <div class="card mx-auto col-md-4 col-lg-3 col-sm-6 d-flex justify-content-between shadow-sm">
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Ukuran sablon</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$sab->ukuran_sablon}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6 mb-3">
                                <h6>Harga sablon</h6>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-6 mb-3">
                                <h6>: {{$sab->harga}}</h6>
                            </div>
                        </div>
                        <!-- Button update modal -->
                        <div class="mb-2 col-4 mx-auto">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalBeli{{$sab->sablon_id}}">
                                <i class="fas fa-shopping-bag"></i>
                                Pesan
                            </button>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>


@foreach($sablon as $row)
<div class="modal fade" id="modalBeli{{$row->sablon_id}}" tabindex=" -1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pesan sablon</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="trx_sablon/addtrxSablon" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-3">
                            @foreach($member as $mbr)
                            @if(Auth::user()->user_id == $mbr->user_id)
                            <input type="text" class="form-control" name="member_id" value="{{$mbr->member_id}}">
                            @endif
                            @endforeach
                            <input class="form-control" type="text" name="sablon_id" value="{{$row->sablon_id}}" aria-label="default input example" autofocus>
                        </div>
                        <div class="col-12 mb-3">
                            <h6>Jumlah</h6>
                            <input class="form-control" type="number" name="jml" placeholder="masukkan jumlah sablon" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-2">
                            @foreach($instansi as $inst)
                            <h6>Kirim desain ke nomor admin : {{$inst->whatsapp}}</h6>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
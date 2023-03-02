@extends('layout.template')
@section('content')

<!-- view read data pesanan -->
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pesanan pakaian custom</h3>
                <p class="text-subtitle text-muted">Selamat datang kembali {{Auth::user()->name}}</p>
            </div>
        </div>
    </div>
    <section class="section">
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
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama pembeli</th>
                                <th class="text-center">Nama produk</th>
                                <th class="text-center">Size order</th>
                                <th class="text-center">Jumlah order</th>
                                <th class="text-center">Staus pembayaran</th>
                                <th class="text-center">Status produksi</th>
                                <th class="text-center">Status pesanan</th>
                                <th class="text-center">Tanggal order</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($pesanan as $val)
                            @if(Auth::user()->role == 'superadmin' && $val->procus_id == TRUE)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->nama_produk}}</td>
                                <td>{{$val->size_order}}</td>
                                <td>{{$val->jml_order}}</td>
                                <td>{{$val->pay_status}}</td>
                                <td>{{$val->stts_produksi}}</td>
                                <td>{{$val->status_pesanan}}</td>
                                <td>{{$val->tgl_order}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->pesanan_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$val->pesanan_id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @elseif(Auth::user()->role == 'kasir' && $val->procus_id == TRUE)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->nama_produk}}</td>
                                <td>{{$val->size_order}}</td>
                                <td>{{$val->jml_order}}</td>
                                <td class="text text-danger">{{$val->pay_status}}</td>
                                <td class="text text-primary">{{$val->stts_produksi}}</td>
                                <td class="text text-primary">{{$val->status_pesanan}}</td>
                                <td>{{$val->tgl_order}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->pesanan_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalValidasi{{$val->pesanan_id}}">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalDiskon{{$val->pesanan_id}}">
                                                <i class="fas fa-percent"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @elseif(Auth::user()->role == 'produksi' && $val->status_pesanan == 'diterima' && $val->procus_id == TRUE)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->nama_lengkap}}</td>
                                <td>{{$val->nama_produk}}</td>
                                <td>{{$val->size}}</td>
                                <td>{{$val->jml_order}}</td>
                                <td>{{$val->ukuran_sablon}}</td>
                                <td class="text text-danger">{{$val->stts_produksi}}</td>
                                <td></td>
                                <td>{{$val->tgl_order}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalInfo{{$val->pesanan_id}}">
                                                <i class="fas fa-info"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalProduction{{$val->pesanan_id}}">
                                                <i class="fas fa-check-square"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach($pesanan as $row)

<!-- Modal validasi pesanan dan pembayaran oleh kasir -->
<div class="modal fade" id="modalValidasi{{$row->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validasi pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pesanan/validasipesanan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" value="{{$row->pesanan_id}}" name="pesanan_id" class="form-control">
                                <h6>Validasi pembayaran</h6>
                                <select name="pay_status" class="form-select" aria-label="Default select example">
                                    <option value="{{$row->pay_status}}" selected>{{$row->pay_status}}</option>
                                    <option value="pending">Pending</option>
                                    <option value="bayar">Bayar</option>
                                    <option value="belum lunas">Belum lunas</option>
                                    <option value="lunas">Lunas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <h6>Validasi pesanan</h6>
                                <select name="status_pesanan" class="form-select" aria-label="Default select example">
                                    <option value="{{$row->status_pesanan}}" selected>{{$row->status_pesanan}}</option>
                                    <option value="pending">Pending</option>
                                    <option value="diterima">Diterima dan produksi</option>
                                    <option value="kirim">Kirim</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    @if($row->status_pesanan == 'pending' && ($row->pay_status == 'bayar'||$row->pay_status == 'belum lunas'||$row->pay_status == 'lunas'))
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i>
                        Ke produksi
                    </button>
                    @elseif($row->status_pesanan == 'pending' || $row->status_pesanan == 'diterima' || $row->status_pesanan == 'kirim' || $row->status_pesanan == 'selesai')
                    <button type="submit" class="btn btn-success">Validasi</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal validasi produksi -->
<div class="modal fade" id="modalProduction{{$row->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validasi proses pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pesanan/validasiproduksi" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" value="{{$row->pesanan_id}}" name="pesanan_id" class="form-control">
                                <h6>Status produksi</h6>
                                <select name="stts_produksi" class="form-select" aria-label="Default select example">
                                    <option value="{{$row->stts_produksi}}" selected>{{$row->stts_produksi}}</option>
                                    <option value="pending">Pending</option>
                                    <option value="produksi">Produksi</option>
                                    <option value="packing">Packing</option>
                                    <option value="kasir">Ke kasir</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    @if($row->stts_produksi == 'pending' || $row->stts_produksi == 'produksi')
                    <button type="submit" class="btn btn-success">Validasi</button>
                    @elseif($row->stts_produksi == 'packing')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i>
                        Ke kasir
                    </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal info pesanan -->
<div class="modal modal-lg" id="modalInfo{{$row->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal info pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @csrf
            <div class="modal-body">
                @if($row->b_dp == TRUE && $row->b_lunas == FALSE)
                <div class="row row-cols-1 row-cols-md-2 g-2">
                    <div class="col mx-auto">
                        <div class="card">
                            <img src="/pembayaran/bukti_dp/{{$row->b_dp}}" class="card-img-top" alt="404">
                            <div class="card-body">
                                <p class="text-center">Bukti DP</p>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($row->b_dp == TRUE && $row->b_lunas == TRUE)
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card">
                            <img src="/pembayaran/bukti_dp/{{$row->b_dp}}" class="card-img-top" alt="404">
                            <div class="card-body">
                                <p class="text-center">Bukti DP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <img src="/pembayaran/bukti_lunas/{{$row->b_lunas}}" class="card-img-top" alt="404">
                            <div class="card-body">
                                <p class="text-center">Bukti Lunas</p>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($row->b_dp == FALSE && $row->b_lunas == TRUE)
                <div class="row row-cols-1 row-cols-md-2 g-2">
                    <div class="col mx-auto">
                        <div class="card">
                            <img src="/pembayaran/bukti_lunas/{{$row->b_lunas}}" class="card-img-top" alt="404">
                            <div class="card-body">
                                <p class="text-center">Bukti Lunas</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Nama pembeli</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->nama_lengkap}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Jasa kirim</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->nama_jakir}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Metode pembayaran</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->pay_method}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Harga satuan</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->harga_jual}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Jumlah order</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->jml_order}}/{{$row->satuan}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Tanggal order</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: {{$row->tgl_order}}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Harga total</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p>: Rp. <?= $total_harga = ($row->jml_order * $row->harga_jual) ?></p>
                    </div>
                    @if($row->b_dp != NULL)
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6>Jumlah DP</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p class="text text-success">: Rp. <?= $row->jml_dp ?></p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-6 mb-1">
                        <h6 class="text text-warning">Sisa bayar</h6>
                    </div>
                    <div class="col-md-3 col-lg-8 col-sm-6 mb-1">
                        <p class="text text-warning">: Rp. <?= $sisa = ($row->jml_order * $row->harga_jual) - $row->jml_dp ?></p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal input diskon -->
<div class="modal fade" id="modalDiskon{{$row->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Diskon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pesanan/diskons" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <h6>Jumlah oreder</h6>
                        </div>
                        <div class="col-5">
                            <p>: <?= $row->jml_order . ' ' . $row->satuan ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h6>Harga satuan</h6>
                        </div>
                        <div class="col-5">
                            <p>: <?= $row->harga_jual, ' / ', $row->satuan ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h6>Jasa kirim</h6>
                        </div>
                        <div class="col-5">
                            <h6 class="text text-danger">: {{$row->nama_jakir}}</h6>
                        </div>
                    </div>
                    @if($row->kurir_id >= 2)
                    <div class="row">
                        <div class="col-4">
                            <h6>Ongkos kirim</h6>
                        </div>
                        <div class="col-5">
                            <p>: Rp.--</p>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-4">
                            <h6>Total produk</h6>
                        </div>
                        <div class="col-5">
                            <p>: <?= $row->jml_order * $row->harga_jual ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h6 class="mt-3">Diskon produk</h6>
                                <input type="text" name="" class="form-control" placeholder="masukkan jumlah diskon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <h6>Total pesanan</h6>
                        </div>
                        <div class="col-5">
                            <p>: <?= $row->jml_order * $row->harga_jual ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="modalDelete{{$row->pesanan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/pesanan/validasipesanan" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <p>Yakin ingin menghapus data ini..?</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    <a href="/pesanan/delpesanan/{{$row->pesanan_id}}" class="btn btn-danger">Delete</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection
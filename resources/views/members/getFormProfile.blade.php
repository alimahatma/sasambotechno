@extends('layout.template')
@section('content')
<div class="content">
    <div class="card mt-5 col-lg-8 col-12 mx-auto shadow-lg">
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title text-center">Lengkapi profile</h4>
            </div>
            <form action="updtakun" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->user_id}}">
                            <h6>Nama lengkap</h6>
                            <input class="form-control" type="text" name="nama_lengkap" placeholder="masukkan nama lengkap" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Telepon</h6>
                            <input class="form-control" type="text" name="telepon" placeholder="masukkan nomor telepon" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Gender</h6>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="L" id="Success">
                                    <label class="form-check-label" for="Success">
                                        Laki-laki
                                    </label>
                                </div>
                                <div class="form-check form-check-success">
                                    <input class="form-check-input" type="radio" name="gender" value="P" id="Success">
                                    <label class="form-check-label" for="Success">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Desa</h6>
                            <input class="form-control" type="text" name="desa" placeholder="masukkan desa" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Kecamatan</h6>
                            <input class="form-control" type="text" name="kecamatan" placeholder="masukkan kecamatan" aria-label="default input example">
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6>Kabupaten</h6>
                            <input class="form-control" type="text" name="kabupaten" placeholder="masukkan kabupaten" aria-label="default input example">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h6>Provinsi</h6>
                            <input class="form-control" type="text" name="provinsi" placeholder="masukkan provinsi" aria-label="default input example">
                        </div>
                    </div>
                    <div class="modal-footer col-1 mx-auto justify-content-center">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
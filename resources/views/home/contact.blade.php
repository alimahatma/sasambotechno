@include('layout.header')
<div class="container">
    <div class="text-center mt-3 mb-2">
        <h2>Contact Us</h2>
        <p>Jika ada kritik dan saran</p>
    </div>
    <div class="card-group">
        @foreach($instansi as $inst)
        <div class="card">
            <div class="card-body">
                <iframe src="{{$inst->alamat}}" width="600" height="450" style="border:10;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$inst->nama_instansi}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$inst->email}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$inst->whatsapp}}" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Pesan / saran</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                </div>
                <div class="d-flex flex-row-reverse bd-highlight size__font">
                    <button type="button" class="btn btn-success">
                        <i class="uil uil-message"></i>Send
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layout.footer')
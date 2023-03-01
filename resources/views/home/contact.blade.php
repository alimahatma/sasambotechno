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
            <form action="/contactus/add" method="post">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="masukkan nama" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="masuklkan email" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control" name="telepon" placeholder="mamsukkan telepon / whatsapp" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Pesan / saran</label>
                        <textarea class="form-control" name="saran" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="d-flex flex-row-reverse bd-highlight size__font">
                        <button type="submit" class="btn btn-success">
                            <i class="uil uil-message"></i>Send
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@include('layout.footer')
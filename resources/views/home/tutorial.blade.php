@include('layout.header')
<div class="container">
    <div class="text-center mt-3 mb-2">
        <h2>Artikel</h2>
        <p>Artikel dan e book</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
        @foreach($tutorials as $row)
        <div class="col">
            <div class="card">
                <img class="card-img-top" src="/gambars/{{$row->gambar}}" alt="Card image cap">
                <div class="card-body">
                    <p class="card-text">{{$row->judul}}
                        <span id="dots">...</span>
                    </p>
                    <p class="card-text style_font" id="more">{{$row->materi}}</p>
                    <div class="col-6">
                        <div class="btn-group mt-3">
                            <button onclick="functionMoreLess()" id="myBtn" class="btn btn-success">Read more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    function functionMoreLess() {
        var dots = document.getElementById("dots"); //get id dots
        var moreText = document.getElementById("more"); //get id more
        var btnText = document.getElementById("myBtn"); //get id myBtn

        if (dots.style.display === "none") { //(id dots) cek style artibut display jika kondisi none maka jalankan perintah di dalamnya
            dots.style.display = "inline"; //(id moreText) rubah element style artibut display menjadi inline
            btnText.innerHTML = "Read more"; //ganti tulisan pada button menjadi Read more
            moreText.style.display = "none"; //(id dots) rubah element style artibut display menjadi none
        } else {
            dots.style.display = "none"; //(id dots) rubah element style artibut display menjadi none
            btnText.innerHTML = "Read less"; //ganti tulisan pada button menjadi Read less
            moreText.style.display = "inline"; //(id moreText) rubah element style artibut display menjadi inline
        }
    }
</script>
@include('layout.footer')
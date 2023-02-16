@include('layout.header')
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
        @foreach($videos as $vid)
        <div class="col">
            <div class="card">
                <iframe height="210px" src="{{$vid->video_link}}" allowfullscreen></iframe>
                <div class="card-body">
                    <p class="card-text style__font">{{$vid->deskripsi}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layout.footer')
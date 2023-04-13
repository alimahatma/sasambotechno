@include('layout.header')
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-between">
        <div class="col-md-4 col-lg-4 col-sm-4">
            @foreach($instansi as $inst)
            <div class="mt-3">
                <img src="/logo/{{$inst->logo}}" class="card-img-bottom" alt="404">
            </div>
            @endforeach
        </div>
        <div class="col-md-5 col-lg-5 col-sm-5">
            <div class="card shadow-lg" style="border-color: #0FAA5D;">
                <div class="card-body">
                    <div class="row">
                        <div class="text text-center mb-3">
                            <h4 class="color__green">Reset Password</h4>
                        </div>
                        <div class="container">
                            <form action="/resetpasswdform" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label class="color__green">Email <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" name="email" placeholder="email@gmail.com" aria-label="default input example">
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label class="color__green">Password <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password" name="password" placeholder="input password" aria-label="default input example">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label class="color__green">Password <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password" name="password_confirmation" placeholder="input password konfirmasi" aria-label="default input example">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mt-4 mb-4">
                                    <a href="/login" class="btn btn-danger me-1 mb-1">Cancel</a>
                                    <button class="btn color-teks" type="submit" style="background-color: #0FAA5D;">Reset password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
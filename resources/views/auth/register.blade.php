@include('layout.header')
<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3 g-4 d-flex justify-content-between" style="border-color: #0FAA5D;">
        <div class="col-md-4 col-lg-4 col-sm-4">
            @foreach($instansi as $inst)
            <div class="mt-5">
                <img src="/logo/{{$inst->logo}}" class="card-img-bottom" alt="404">
            </div>
            @endforeach
        </div>
        <div class="col-md-5 col-lg-5 col-sm-5">
            <div class="card shadow-lg" style="border-color: #0FAA5D;">
                <div class="card-body">
                    <div class="row">
                        <div class="text text-center">
                            <h4 class="color__green">Register akun</h4>
                        </div>
                        <div class="container">
                            <form action="addRegister" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label>Username <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('name') is-invalid @enderror" type="text" name="name" placeholder="your username" aria-label="default input example" value="{{ old('name') }}" required autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label>Email <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('email') is-invalid @enderror" type="email" name="email" placeholder="email@gmail.com" aria-label="default input example">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="col">
                                            <label>Password <span class="text text-danger">*</span></label>
                                            <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password" name="password" placeholder="input password" aria-label="default input example">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 d-md-block mt-5">
                                    <button class="btn btn-sm col-12" style="background-color: #0FAA5D;" type="submit">Register</button>
                                </div>
                                <div class="d-flex justify-content-center mt-4 mb-2">
                                    <a class="text-decoration-none text-center" href="/login" style="color: #0FAA5D;">Login</a>
                                    <p style="color: #0FAA5D;"> / </p>
                                    <a class="text-decoration-none text-center" href="requestReset" style="color: #0FAA5D;">Forgot Password</a>
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
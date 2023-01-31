@include('layout.header')
<div class="container mt-4">
    <div class="row justify-content-between">
        <div class="col-sm-4 col-md-4 col-xl-3">
            <div class="page-header mx-auto  mt-2">
                @foreach($instansi as $inst)
                <img src="/logo/{{$inst->logo}}" width="450" height="220" alt="404">
                @endforeach
            </div>
            <div class="page-content">
            </div>
        </div>
        <div class="col-sm-6 col-md-4 col-xl-3">
            <div class="card shadow rounded">
                <div class="page-header mx-auto  mt-2">
                    <h6>Login</h6>
                </div>
                <div class="container">
                    <form action="loginAuth" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group mt-2">
                                <div class="col">
                                    <label>Email</label>
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
                                    <label>Password</label>
                                    <input class="form-control form-control-sm @error('password') is-invalid @enderror" type="password" name="password" placeholder="input password" aria-label="default input example">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2 d-md-block mt-3 mb-3">
                            <button class="btn btn-sm col-12" style="background-color: #40883C;" type="submit">Login</button>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-9 col-md-9 col-lg-9 mx-auto">
                                <a class="text-decoration-none text-center" href="register" style="color: #40883C;">sign up /</a>
                                <a class="text-decoration-none text-center" href="requestReset" style="color: #40883C;">forgot password</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
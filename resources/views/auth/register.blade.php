@extends('layout.template')
@section('content')
<div class="container mt-4">
    <div class="card-body">
        <div class="card col-md-4 col-lg-4">
            <div class="page-header mx-auto  mt-2">
                <h4>Register akun</h4>
            </div>
            <div class="page-content">
                <form action="addRegister" method="post">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="form-group mt-2">
                                <div class="col">
                                    <label>Username</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="your username" aria-label="default input example" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <div class="col">
                                    <label>Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="email@gmail.com" aria-label="default input example">
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
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="input password" aria-label="default input example">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-2">
                            <div class="col-6 d-flex justify-content-around mx-auto">
                                <button type="button" class="btn btn-outline-danger btn-sm">Cancel</button>
                                <button type="submit" class="btn btn-outline-success btn-sm">Register</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
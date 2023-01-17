@extends('layout.template')
@section('content')
<div class="container mt-4">
    <div class="card-body">
        <div class="card col-md-6 col-lg-6">
            <div class="page-header mx-auto">
                <h4>Login</h4>
            </div>
            <div class="page-content">
                <form action="loginAuth" method="post">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="form-group">
                                <div class="col">
                                    <h6>Email</h6>
                                    <input class="form-control" type="email" name="email" placeholder="email@gmail.com" aria-label="default input example">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <h6>Password</h6>
                                    <input class="form-control" type="password" name="password" placeholder="input password" aria-label="default input example">
                                </div>
                            </div>
                        </div>
                        <div class="col-4 mx-auto">
                            <button class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
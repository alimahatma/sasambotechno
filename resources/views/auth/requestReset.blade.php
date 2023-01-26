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
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card">
                <div class="page-header mx-auto  mt-2">
                    <h6>Send reset password</h6>
                </div>
                <div class="container">
                    <form action="sendResetPasswd" method="post">
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
                        </div>
                        <div class="col-12 d-flex justify-content-center mx-auto mt-2">
                            <div class="col-sm-6 col-md-6 col-lg-6 ml-4 mx-auto">
                                <a href="/login" class="btn btn-danger me-1 mb-1">Cancel</a>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 ml-4 mx-auto">
                                <button type="submit" class="btn me-1 mb-1" style="background-color: #40883C;">Send reset password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
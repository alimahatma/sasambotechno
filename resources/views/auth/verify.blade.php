<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="col-sm-6 col-lg-6 mx-auto">
            <div class="bg-light p-5 rounded mt-5 shadow-lg">
                <h2>Verifikasi</h2>
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    Link verifikasi telah di kirim ke email anda..!
                    Jika belum menerima email verifikasi, silahkan klik tombol di bawah <br>
                    untuk kirim ulang email verifikasi.
                </div>
                @endif
                <p style="text-align: justify;">
                    Klik tombol di bawah untuk mendapatkan link verifikasi email<br>
                    <br>
                </p>
                <div class="mt-2">
                    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link reset</title>
</head>

<body>
    <h1>Forget Password Email</h1>

    klik link ini untuk reset password anda:
    <a href="{{ url('resetpasswdform') }}/{{$token}}">Reset Password</a>
</body>

</html>
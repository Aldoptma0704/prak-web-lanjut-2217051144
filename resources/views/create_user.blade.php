<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/create_user.css') }}">
</head>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="card">
            <div class="card-body">
                @include('_form', [
                    'action' => route('user.store'), // action menuju route penyimpanan user
                    'kelas' => $kelas, // data kelas dikirim ke partial form
                ])
            </div>
        </div>
    </div>
</body>
</html>
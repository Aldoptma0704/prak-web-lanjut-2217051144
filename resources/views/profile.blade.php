<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css') }}">
</head>
<body>

    <div class="content">
        <div class="profil-img">
        <img src="{{ asset('assets/img/PAS FOTO ALDO.jpg') }}" alt="Foto Profile">
        </div>
        <div class="item"><?= $nama ?></div>
        <div class="item"><?= $npm ?></div>
        <div class="item"><?= $kelas ?></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

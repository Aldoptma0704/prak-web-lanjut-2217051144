@extends('layouts.app')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
@endsection

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg" style="width: 22rem; border-radius: 15px;">
            @if($user->foto)
                <div class="profil-img text-center mt-4">
                    <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="Foto Profile" class="rounded-circle img-fluid border border-3" style="width: 180px; height: 180px; object-fit: cover;">
                </div>
            @else
                <div class="text-center mt-4">
                    <p class="text-muted">Foto Tidak Tersedia</p>
                </div>
            @endif
            <div class="card-body text-center">
                <h3 class="card-title">{{ $user->nama }}</h3>
                <p class="card-text text-muted">{{ $user->npm }}</p>
                <p class="card-text text-muted">{{ $kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</p>
            </div>

            <div class="card-footer bg-transparent text-center">
                <a href="{{ route('user.list') }}" class="btn btn-primary btn-lg btn-block" style="border-radius: 25px;">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke List User
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Include FontAwesome for icons -->
@endsection

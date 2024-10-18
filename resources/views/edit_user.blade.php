@extends('layouts.app') 
    
@section('content') 
<div> 
    <!-- Isi Section --> 
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%; border-radius: 15px;">
            <h4 class="text-center mb-4">Update User Information</h4>
            <div class="card-body">
                <form action="{{ route('user.update', $user['id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="mb-4">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $user->nama ?? '') }}" required>
                        @foreach($errors->get('nama') as $message)
                            <div class="text-danger">{{ $message }}</div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" id="npm" name="npm" class="form-control" value="{{ old('npm', $user->npm ?? '') }}" required>
                        @foreach($errors->get('npm') as $message)
                            <div class="text-danger">{{ $message }}</div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-select" required>
                            @foreach($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $user->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
                                    {{ $kelasItem->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                        @foreach($errors->get('kelas_id') as $message)
                            <div class="text-danger">{{ $message }}</div>
                        @endforeach
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                        @if($user->foto)
                        <div class="mt-3">
                            <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="Foto User" class="img-thumbnail" width="100">
                        </div>
                        @endif
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        <a href="{{ route('user.list') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke List User
                        </a>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</div>
@endsection

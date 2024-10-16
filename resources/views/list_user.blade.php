@extends('layouts.app') 
 
@section ('content') 
<div class="container mt-5">
   <div class="row">
      <div class="col-md-12">
         <a href="{{ route('user.create') }}" class="btn btn-sm btn-danger">Tambah Pengguna Baru</a>
         <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white">
               <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>NPM</th>
                  <th>Kelas</th>
                  <th>Foto</th>
                  <th>Aksi</th>
               </tr>
            </thead>
            <tbody>
               @foreach($users as $user)
               <tr class="@if($loop->iteration % 2 == 0) table-secondary @else table-light @endif">
                  <td>{{ $user['id'] }}</td>
                  <td>{{ $user['nama'] }}</td>
                  <td>{{ $user['npm'] }}</td>
                  
                  <td>{{ $user['nama_kelas'] }}</td>
                  <td>
                     <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="Foto User" width="100">
                  </td>
                  <td>
                     <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                     <a href="#" class="btn btn-sm btn-primary">Edit</a>
                     <a href="#" class="btn btn-sm btn-danger">Delete</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection 

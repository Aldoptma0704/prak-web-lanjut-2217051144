<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function profile($nama = “”, $kelas = “”, $npm = 
    “”) 
    { 
        $data = [ 
            'nama' => $nama, 
            'kelas' => $kelas, 
            'npm' => $npm, 
            ];
        return view('profile', $data); 
    } 

    public function create(){ 
        return view('create_user', [
            'kelas' => Kelas::all(),
        ]); 
        } 
    
    public function store(StoreUserRequest $request) 
    { 
        $validateData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);
    
        $user = UserModel::create($validateData);
    
        $user->load('kelas');
    
        return view('profile', [
            'nama' => $request->input('nama'), 
            'nama_kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan', 
            'npm' => $request->input('npm'), 
        ]);
    }
}

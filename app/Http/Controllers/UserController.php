<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\UserModel;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public $userModel; 
    public $kelasModel; 

    public function __construct() 
    { 
        $this->userModel = new UserModel(); 
        $this->kelasModel = new Kelas(); 
    }

    public function index() 
    { 
        $data = [ 
            'title' => 'Create User', 
            'users' => $this->userModel->getUser(), 
        ]; 
    
        return view('list_user', $data); 
    } 
    

    public function profile($nama = “”, $kelas = “”, $npm = 
    “”) 
    { 
        $data = [ 
            'nama' => $nama, 
            'kelas' => $kelas, 
            'npm' => $npm, 
            ]; 
        return view('profile',$data); 
    }
    
    public function create(){ 

        $kelasModel = new Kelas();

        $kelas =  $this->kelasModel->getKelas();

        $data = [ 
            'title' => 'Create User',
            'kelas' => $kelas, 
            ]; 
        
        return view('create_user', $data);
        // return view('create_user', [
        //     'kelas' => Kelas::all(),
        // ]); 
    }

    public function show($id){
        $user = $this->userModel->getUser($id);

        $kelas = $this->kelasModel->find($user->kelas_id);

        $title = ' Show User ' . $user->nama;

        return view('show_user', compact('user','kelas', 'title'));
    }

    public function store(StoreUserRequest $request) 
    { 
        //validasi input
        $request->validate([
            'nama' => 'required',
            'npm' => 'required',
            'kelas_id' => 'required',
            'foto' => 'image|file|max:10240', //validasi foto
        ]);

        //proses up foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename); // Menyimpan file ke storage
    
            // Simpan data user ke database
            $this->userModel->create([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id'),
                'foto' => $filename, // Menyimpan nama file ke database
            ]);
        }
        return redirect()->to('/user/list');

    }

}

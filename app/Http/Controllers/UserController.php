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
    

    public function profile($nama = '', $kelas = '', $npm = 
    '') 
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

    public function edit($id){
        $user = UserModel::findOrFail($id);
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $title = 'Edit User';
        return view('edit_user', compact('user','kelas','title'));
    }

    public function update(StoreUserRequest $request, $id){
        $user = UserModel::findOrFail($id);

        $validatedData = $request->validated();

        $user->nama = $validatedData['nama'];
        $user->npm = $validatedData['npm'];
        $user->kelas_id = $validatedData['kelas_id'];

        // Cek apakah ada foto yang di upload
        if($request->hasFile('foto')){
            // ambil nama file foto dari db
            $oldFilename = $user->foto;
            
            // Hapus foto lama jika ada
            if($oldFilename){
                $old = public_path('storage/uploads/' . $oldFilename);
                // cek apakah file lama ada dan hapus
                if(file_exists($oldFilename)){
                    unlink($oldFilename); //hapus foto lama dari folder
                }
            }

            //simpan file baru dengan storeas
            $file = $request->file('foto');
            $newFilename = time() . '=' . $file->getClientOriginalName();
            $file->storeAs('uploads', $newFilename, 'public'); //menyimpan file kefolder up

            //upload name file di database
            $user->foto = $newFilename;
        }

        $user->save();

        return redirect()->route('user.list')->with('succes', 'User updated successfully');
    }

    public function destroy($id){
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->to('/user/list')->with('succes', 'user has been deleted successfully');
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
        return redirect()->to('/')->with('succes', 'user has been created successfully');

        $validatedData = $request->validated();

        $user = UserModel::create($validatedData);

        $user->load('kelas');

        return view('profile', [
            'nama' => $user->nama,
            'npm' => $user->npm,
            'nama_kelas' => $user->kelas->nama_kelas ?? 'kelas tidak ditemukan',
        ]);

    }

}

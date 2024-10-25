<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];
    protected $fillable = ['nama', 'npm', 'kelas_id','jurusan_id', 'foto'];

    // Fungsi untuk mendapatkan data user
    public function getUser($id = null)
    { 
        if ($id != null) {
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                        ->join('jurusan', 'jurusan.id', '=', 'user.jurusan_id')
                        ->join('fakultas', 'fakultas.id', '=', 'jurusan.fakultas_id') 
                        ->select('user.*', 'kelas.nama_kelas as nama_kelas', 'jurusan.nama_jurusan as nama_jurusan', 'fakultas.nama_fakultas as nama_fakultas')
                        ->where('user.id', $id)
                        ->first();
        }

        return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
                    ->join('jurusan', 'jurusan.id', '=', 'user.jurusan_id')
                    ->join('fakultas', 'fakultas.id', '=', 'jurusan.fakultas_id')
                    ->select('user.*', 'kelas.nama_kelas as nama_kelas', 'jurusan.nama_jurusan as nama_jurusan', 'fakultas.nama_fakultas as nama_fakultas')
                    ->orderBy('user.id', 'asc')
                    ->get(); 
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

}

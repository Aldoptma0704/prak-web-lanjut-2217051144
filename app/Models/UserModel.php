<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'user';
    protected $guarded = ['id'];
    protected $fillable = ['nama', 'npm', 'kelas_id', 'foto']; 


    public function kelas()
    {
        return $this->belongsTO(Kelas::class, 'kelas_id');
    }

    public function getUser($id = null){ 
        if ($id != null){
            return $this->join('kelas', 'kelas.id', '=', 'user.kelas_id')
            ->select('user.*', 'kelas.nama_kelas')
            ->where('user.id', $id)
            ->first();
        }
        return $this->join('kelas', 'kelas.id', '=', 
        'user.kelas_id')->select('user.*', 'kelas.nama_kelas as 
        nama_kelas')->orderby('user.id', 'asc')->get(); 
        }
}

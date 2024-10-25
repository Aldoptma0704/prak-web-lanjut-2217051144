<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $fillable = ['nama_jurusan', 'fakultas_id'];

    public function fakultas()
    {
        return $this->hasMany(Fakultas::class, 'fakultas_id');  
    }
}

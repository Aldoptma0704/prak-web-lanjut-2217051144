<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan; 

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Ilmu Komputer',
            'Fisika',
            'Kimia',
            'Biologi',
        ];

        foreach ($data as $Jurusan) {
            Jurusan::create([
                'nama_jurusan' => $Jurusan,
                'fakultas_id' => 1,
            ]);
        }
    }
}

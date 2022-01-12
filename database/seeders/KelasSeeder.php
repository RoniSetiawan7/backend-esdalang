<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            [
                'kode_kelas' => 7,
                'nm_kelas' => 'Tujuh'
            ],
            [
                'kode_kelas' => 8,
                'nm_kelas' => 'Delapan'
            ],
            [
                'kode_kelas' => 9,
                'nm_kelas' => 'Sembilan'
            ],
        ]);
    }
}

<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\HasilLatihan;
use App\Models\LoginSiswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $fillable = [
        'nis', 'nm_siswa', 'jk', 'tempat_lahir', 'tgl_lahir',
        'agama', 'alamat', 'no_telp', 'id_kelas', 'sub_kelas', 'foto_siswa', 'foto_path',
    ];
    protected $hidden = ['created_at', 'updated_at'];

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function getHasilLatihan()
    {
        return $this->hasMany(HasilLatihan::class, 'id_siswa');
    }

    public function getAuth()
    {
        return $this->hasOne(LoginSiswa::class, 'id_siswa');
    }
}

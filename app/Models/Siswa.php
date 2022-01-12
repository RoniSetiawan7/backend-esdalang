<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    protected $fillable = [
        'nis', 'nm_siswa', 'jk', 'tempat_lahir', 'tgl_lahir',
        'agama', 'alamat', 'no_telp', 'id_kelas', 'sub_kelas', 'password'
    ];
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}

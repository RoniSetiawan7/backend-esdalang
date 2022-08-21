<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginSiswa extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'login_siswa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_siswa', 'password'
    ];
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

    public function getSiswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

}

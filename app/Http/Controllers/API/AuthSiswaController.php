<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Siswa;
use App\Models\LoginSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Http\Resources\Siswa as SiswaResource;


class AuthSiswaController extends BaseController
{
    //REGISTRASI AKUN SISWA
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_siswa' => 'required|unique:login_siswa',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'id_siswa.required' => 'NIS wajib diisi',
                'id_siswa.unique' => 'NIS telah digunakan untuk mendaftar akun',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password dan Konfirmasi Password tidak cocok',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $cekSiswa = Siswa::where('nis', '=', $request->input('id_siswa'))->first();
        if ($cekSiswa === null) {
            return $this->sendError('Unauthorised.', ['error' => 'Mohon maaf, NIS anda tidak terdaftar di server']);
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $siswa = LoginSiswa::create($input);
    
            $siswa = LoginSiswa::where('id_siswa', $request->id_siswa)->first();
    
            $success['nis'] = $siswa->id_siswa;
            $success['nm_siswa'] = $siswa->getSiswa['nm_siswa'];
            $success['id_kelas'] = $siswa->getSiswa['id_kelas'];
            $success['sub_kelas'] = $siswa->getSiswa['sub_kelas'];
            $success['foto_path'] = $siswa->getSiswa['foto_path'];
            $success['token'] = $siswa->createToken('Register')->plainTextToken;
    
            return $this->sendResponse($success, 'Selamat, akun anda berhasil didaftarkan!');
        }
    }

    //LOGIN AKUN SISWA
    public function login(Request $request)
    {
        $request->input(
            [
                'id_siswa' => 'required',
                'password' => 'required'
            ],
            [
                'id_siswa.required' => 'NIS wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $siswa = LoginSiswa::where('id_siswa', $request->id_siswa)->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {

            $siswa->tokens()->delete();

            $success['nis'] = $siswa->id_siswa;
            $success['nm_siswa'] = $siswa->getSiswa['nm_siswa'];
            $success['id_kelas'] = $siswa->getSiswa['id_kelas'];
            $success['sub_kelas'] = $siswa->getSiswa['sub_kelas'];
            $success['foto_path'] = $siswa->getSiswa['foto_path'];
            $success['token'] = $siswa->createToken('Login')->plainTextToken;

            return $this->sendResponse($success, 'Login berhasil');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'NIS atau Password salah']);
        }
    }

    //UPDATE DATA SISWA
    public function update(Request $request, Siswa $siswa, $id)
    {
        $input = $request->all();

        $validator = Validator::make(
            $input,
            [
                'nm_siswa' => 'required',
                'jk' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tgl_lahir' => 'nullable',
                'agama' => 'nullable',
                'alamat' => 'nullable',
                'no_telp' => 'nullable',
                'id_kelas' => 'required',
                'sub_kelas' => 'required',
            ],
            [
                'nm_siswa.required' => 'Nama wajib diisi',
                'id_kelas.required' => 'Kelas wajib diisi',
                'sub_kelas.required' => 'Sub Kelas wajib diisi',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return $this->sendResponse(new SiswaResource($siswa), 'Data siswa berhasil diperbarui.');
    }

    //LOGOUT AKUN SISWA
    public function logout()
    {
        $success['logout'] = auth()->user()->tokens()->delete();
        return $this->sendResponse($success, 'Logout berhasil.');
    }

    //DETAIL DATA SISWA
    public function profile(Request $request)
    {
        $user = auth()->user();
        $success['nis'] = $user->id_siswa;
        $success['nm_siswa'] = $user->getSiswa['nm_siswa'];
        $success['jk'] = $user->getSiswa['jk'];
        $success['tempat_lahir'] = $user->getSiswa['tempat_lahir'];
        $success['tgl_lahir'] = $user->getSiswa['tgl_lahir'];
        $success['agama'] = $user->getSiswa['agama'];
        $success['alamat'] = $user->getSiswa['alamat'];
        $success['no_telp'] = $user->getSiswa['no_telp'];
        $success['id_kelas'] = $user->getSiswa['id_kelas'];
        $success['sub_kelas'] = $user->getSiswa['sub_kelas'];
        $success['foto_path'] = $user->getSiswa['foto_path'];
        return response($success);
    }
}

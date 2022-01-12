<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Siswa;
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
                'nis' => 'required|unique:siswa',
                'nm_siswa' => 'required',
                'password' => 'required|min:8|confirmed',
                'jk' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tgl_lahir' => 'nullable',
                'agama' => 'nullable',
                'alamat' => 'nullable',
                'no_telp' => 'nullable',
                'id_kelas' => 'nullable',
                'sub_kelas' => 'nullable',
            ],
            [
                'nis.required' => 'NIS wajib diisi',
                'nis.unique' => 'NIS telah digunakan oleh siswa lain',
                'nm_siswa.required' => 'Nama wajib diisi',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Password dan Konfirmasi Password tidak cocok',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $siswa = Siswa::create($input);

        $siswa = Siswa::where('nis', $request->nis)->first();

        $success['nis'] = $siswa->nis;
        $success['nm_siswa'] = $siswa->nm_siswa;
        $success['token'] = $siswa->createToken('Register')->plainTextToken;

        return $this->sendResponse($success, 'Selamat, akun anda berhasil didaftarkan!');
    }

    //LOGIN AKUN SISWA
    public function login(Request $request)
    {
        $request->input(
            [
                'nis' => 'required',
                'password' => 'required'
            ],
            [
                'nis.required' => 'NIS wajib diisi',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $siswa = Siswa::where('nis', $request->nis)->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {

            $siswa->tokens()->delete();

            $success['nis'] = $siswa->nis;
            $success['nm_siswa'] = $siswa->nm_siswa;
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
                'jk' => 'required',
                'tempat_lahir' => 'nullable',
                'tgl_lahir' => 'nullable',
                'agama' => 'required',
                'alamat' => 'nullable',
                'no_telp' => 'nullable',
                'id_kelas' => 'required',
                'sub_kelas' => 'required',
            ],
            [
                'nm_siswa.required' => 'Nama wajib diisi',
                'jk.required' => 'Jenis Kelamin wajib diisi',
                'agama.required' => 'Agama wajib diisi',
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
        return $request->user();
    }
}

@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-left">
                <h1>Detail Siswa</h1>
            </div>
        </div>
        <div class="col-lg-12 margin-tb mb-3">
            <div class="float-right">
                <a href="{{ route('index-siswa') }}" class="btn btn-outline-primary pull-right mb-3"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>NIS</th>
                <td> : {{ $student->nis }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td> : {{ $student->nm_siswa }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td> : {{ $student->jk == 'L' ? 'Laki-laki' : ($student->jk == 'P' ? 'Perempuan' : '') }}</td>
            </tr>
            <tr>
                <th>Tempat Lahir</th>
                <td> : {{ $student->tempat_lahir }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td> : {{ $student->tgl_lahir }}</td>
            </tr>
            <tr>
                <th>Agama</th>
                <td> : {{ $student->agama }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td> : {{ $student->alamat }}</td>
            </tr>
            <tr>
                <th>No. Telp</th>
                <td> : {{ $student->no_telp }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td> : {{ $student->getKelas['nm_kelas'] }}</td>
            </tr>
            <tr>
                <th>Sub Kelas</th>
                <td> : {{ $student->sub_kelas }}</td>
            </tr>
        </table>
    </div>
@endsection

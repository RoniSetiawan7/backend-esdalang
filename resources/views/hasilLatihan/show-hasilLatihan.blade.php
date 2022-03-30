@extends('layouts.form')

@section('form')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h1>Hasil Latihan</h1>
            </div>
        </div>
        <div class="col-lg-12 margin-tb mb-3">
            <div class="float-right">
                <a href="{{ route('index-hasilLatihan') }}" class="btn btn-outline-primary pull-right mb-3"><i
                        class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>NIS</th>
                <td> : {{ $result->id_siswa }}</td>
            </tr>
            <tr>
                <th>Kode Latihan</th>
                <td> : {{ $result->id_latihan }}</td>
            </tr>
            <tr>
                <th>Jawaban</th>
                <td> : {{ preg_replace('/[{}]/', '', $result->jawaban) }}</td>
            </tr>
            <tr>
                <th>Nilai</th>
                <td> : {{ $result->nilai }}</td>
            </tr>
        </table>
    </div>
@endsection

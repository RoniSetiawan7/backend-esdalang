@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Tambah Data Siswa</h2>
            </div>
        </div>
    </div>
    <hr>
    <br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('store-siswa') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Foto Siswa :</label>
                <input type="file" name="foto_siswa" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>NIS : <label class="text-danger">*</label></label>
                <input type="number" name="nis" value="{{ old('nis') }}" class="form-control"
                    placeholder="Nomor Induk Siswa">
            </div>
            <div class="form-group col-md-6">
                <label>Nama Siswa : <label class="text-danger">*</label></label>
                <input type="text" name="nm_siswa" value="{{ old('nm_siswa') }}" class="form-control">
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin :</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="radio" name="jk" value="L" {{ old('jk') == 'L' ? 'checked' : '' }}>
                        Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jk" value="P" {{ old('jk') == 'P' ? 'checked' : '' }}>
                        Perempuan
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-row">
            <div class="form-group col-6">
                <label>Tempat Lahir :</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control">
            </div>
            <div class="form-group col">
                <label>Tanggal Lahir :</label>
                <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}" class="form-control">
            </div>
            <div class="form-group col">
                <label>Agama :</label>
                <select class="form-control" name="agama">
                    <option value=""> Pilih Agama </option>
                    <option value="Islam" @if (old('agama') == 'Islam') {{ 'selected' }} @endif>Islam</option>
                    <option value="Protestan" @if (old('agama') == 'Protestan') {{ 'selected' }} @endif>Protestan
                    </option>
                    <option value="Katholik" @if (old('agama') == 'Katholik') {{ 'selected' }} @endif>Katholik</option>
                    <option value="Hindu" @if (old('agama') == 'Hindu') {{ 'selected' }} @endif>Hindu</option>
                    <option value="Buddha" @if (old('agama') == 'Buddha') {{ 'selected' }} @endif>Buddha</option>
                    <option value="Konghucu" @if (old('agama') == 'Konghucu') {{ 'selected' }} @endif>Konghucu</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat :</label>
            <textarea name="alamat" class="form-control" rows="3">{{ old('alamat') }}</textarea>
        </div>

        <div class="form-group">
            <label>No. Telp :</label></label>
            <input type="text" name="no_telp" value="{{ old('no_telp') }}" class="form-control">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Kelas : <label class="text-danger">*</label></label>
                <select class="form-control" name="id_kelas">
                    <option value="">Pilih Kelas</option>
                    @foreach ($class as $c)
                        @if (old('id_kelas') == $c->kode_kelas)
                            <option value="{{ $c->kode_kelas }}" selected>{{ $c->nm_kelas }}</option>
                        @else
                            <option value="{{ $c->kode_kelas }}">{{ $c->nm_kelas }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Sub Kelas : <label class="text-danger">*</label></label>
                <select class="form-control" name="sub_kelas">
                    <option value=""> Pilih Sub Kelas </option>
                    <option value="A" @if (old('sub_kelas') == 'A') {{ 'selected' }} @endif>A</option>
                    <option value="B" @if (old('sub_kelas') == 'B') {{ 'selected' }} @endif>B</option>
                    <option value="C" @if (old('sub_kelas') == 'C') {{ 'selected' }} @endif>C</option>
                    <option value="D" @if (old('sub_kelas') == 'D') {{ 'selected' }} @endif>D</option>
                    <option value="E" @if (old('sub_kelas') == 'E') {{ 'selected' }} @endif>E</option>
                    <option value="F" @if (old('sub_kelas') == 'F') {{ 'selected' }} @endif>F</option>
                </select>
            </div>
        </div>

        <div class="form-group text-right">
            <a href="{{ route('index-siswa') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

        <script>
            $(function() {
                @if (Session::has('errors'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: '<div>Ada kesalahan dalam mengisi data,<br />silahkan dicek kembali.<br /></div>',
                    })
                @endif
            });
        </script>
    </form>
@endsection

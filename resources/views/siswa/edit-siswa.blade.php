@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Edit Data Siswa</h2>
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

    <form action="{{ route('update-siswa', $student->nis) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Foto Siswa :</label>
                <input type="file" name="foto_siswa" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <img src="{{ Storage::url('public/profile/' . $student->foto_siswa) }}" width="200px">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>NIS :</label>
                <input type="number" name="nis" value="{{ $student->nis }}" readonly class="form-control"
                    placeholder="Nomor Induk Siswa">
            </div>
            <div class=" form-group col-md-6">
                <label>Nama Siswa:</label>
                <input type="text" name="nm_siswa" value="{{ $student->nm_siswa }}" class="form-control">
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin :</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="radio" name="jk" value="L" {{ $student->jk == 'L' ? 'checked' : '' }}>
                        Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jk" value="P" {{ $student->jk == 'P' ? 'checked' : '' }}>
                        Perempuan
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-row">
            <div class="form-group col-6">
                <label>Tempat Lahir:</label>
                <input type="text" name="tempat_lahir" value="{{ $student->tempat_lahir }}" class="form-control">
            </div>
            <div class="form-group col">
                <label>Tanggal Lahir :</label>
                <input type="date" name="tgl_lahir" value="{{ $student->tgl_lahir }}" class="form-control">
            </div>
            <div class="form-group col">
                <label>Agama :</label>
                <select class="form-control" name="agama">
                    <option value="">Pilih Agama</option>
                    <option value="Islam" {{ $student->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Protestan" {{ $student->agama == 'Protestan' ? 'selected' : '' }}>Protestan</option>
                    <option value="Katholik" {{ $student->agama == 'Katholik' ? 'selected' : '' }}>Katholik</option>
                    <option value="Hindu" {{ $student->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $student->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ $student->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat :</label>
            <textarea name="alamat" class="form-control" rows="3">{{ $student->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label>No. Telp <label class="text-danger">(Opsional) :</label></label>
            <input type="text" name="no_telp" value="{{ $student->no_telp }}" class="form-control">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Kelas :</label>
                <select class="form-control" name="id_kelas">
                    <option value="">Pilih Kelas</option>
                    @foreach ($class as $c)
                        <option disable="true" value="{{ $c->kode_kelas }}"
                            {{ $c->kode_kelas == $student->id_kelas ? 'selected' : '' }}>
                            {{ $c->nm_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Sub Kelas :</label>
                <select class="form-control" name="sub_kelas">
                    <option value="">Pilih Sub Kelas</option>
                    <option value="A" {{ $student->sub_kelas == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $student->sub_kelas == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $student->sub_kelas == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $student->sub_kelas == 'D' ? 'selected' : '' }}>D</option>
                    <option value="E" {{ $student->sub_kelas == 'E' ? 'selected' : '' }}>E</option>
                    <option value="F" {{ $student->sub_kelas == 'F' ? 'selected' : '' }}>F</option>
                </select>
            </div>
        </div>

        <div class="form-group text-right">
            <a href="{{ route('index-siswa') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>

        <!-- Sweet Alert -->
        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        @endpush

    </form>
@endsection

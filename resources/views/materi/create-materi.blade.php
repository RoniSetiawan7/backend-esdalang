@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Tambah Data Materi</h2>
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

    <form action="{{ route('store-materi') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Kode Materi :</label>
                <input type="text" name="kode_materi" value="{{ old('kode_materi') }}" class="form-control"
                    placeholder="Kelas-Mapel-Bab Materi">
            </div>
            <div class="form-group col-md-3">
                <label>Nama Materi :</label>
                <input type="text" name="nm_materi" value="{{ old('nm_materi') }}" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Bab Materi:</label>
                <input type="number" name="bab" value="{{ old('bab') }}" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label>Kelas :</label>
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
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Nama Guru Pengampu :</label>
                <select class="form-control" name="id_guru">
                    <option value="">Pilih Guru</option>
                    @foreach ($teacher as $t)
                        @if (old('id_guru') == $t->nip)
                            <option value="{{ $t->nip }}" selected>{{ $t->nm_guru }}</option>
                        @else
                            <option value="{{ $t->nip }}">{{ $t->nm_guru }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>File Materi :</label>
                <input type="file" name="file_materi" value="{{ old('file_materi') }}" class="form-control">
            </div>
        </div>

        <div class="form-group text-right">
            <a href="{{ route('index-materi') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i>
                Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
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

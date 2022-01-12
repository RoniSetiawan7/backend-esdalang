@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Tambah Latihan</h2>
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

    <form action="{{ route('storeLatihan') }}" method="POST" autocomplete="off">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Kode Latihan :</label>
                <input type="text" name="kode_latihan" value="{{ old('kode_latihan') }}" class="form-control"
                    placeholder="LAT-Kelas-Mapel">
            </div>
            <div class="form-group col-md-4">
                <label>Nama Latihan :</label>
                <input type="text" name="nm_latihan" value="{{ old('nm_latihan') }}" class="form-control">
            </div>

            <div class="form-group col-md-4">
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

        <div class="form-group">
            <label>Guru Pengajar :</label>
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

        <div class="form-group text-right">
            <a href="{{ route('indexLatihan') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
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

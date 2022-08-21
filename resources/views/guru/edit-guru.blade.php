@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Edit Data Guru</h2>
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
    <form action="{{ route('update-guru', $teacher->nip) }}" method="POST" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>NIP :</label>
                <input type="number" name="nip" value="{{ $teacher->nip }}" readonly class="form-control"
                    placeholder="Nomor Induk Pegawai">
            </div>
            <div class="form-group col-md-6">
                <label>Nama Guru:</label>
                <input type="text" name="nm_guru" value="{{ $teacher->nm_guru }}" class="form-control">
            </div>
        </div>

        <fieldset class="form-group">
            <div class="row">
                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin :</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input type="radio" name="jk" value="L" {{ $teacher->jk == 'L' ? 'checked' : '' }}>
                        Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="jk" value="P" {{ $teacher->jk == 'P' ? 'checked' : '' }}>
                        Perempuan
                        </label>
                    </div>
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <label>Alamat :</label>
            <textarea name="alamat" class="form-control" rows="3" required>{{ $teacher->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label>No. Telp <label class="text-danger">(Opsional) :</label></label>
            <input type="text" name="no_telp" value="{{ $teacher->no_telp }}" class="form-control">
        </div>

        <div class="form-group text-right">
            <a href="{{ route('index-guru') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
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

@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Edit Data Kurikulum</h2>
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

    <form action="{{ route('update-kurikulum', $curriculum->kode_kurikulum) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Kode Kurikulum :</label>
                <input type="text" name="kode_kurikulum" value="{{ $curriculum->kode_kurikulum }}" readonly
                    class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Mata Pelajaran :</label>
                <select class="form-control" name="id_materi">
                    <option value="">Pilih Mata Pelajaran</option>
                    @foreach ($filterSubject as $sub)
                        <option disable="true" value="{{ $sub->kode_materi }}"
                            {{ $sub->kode_materi == $curriculum->id_materi ? 'selected' : '' }}>
                            {{ $sub->nm_materi }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label>Kelas:</label>
                <select class="form-control" name="id_kelas">
                    <option value="">Pilih Kelas</option>
                    @foreach ($class as $c)
                        <option disable="true" value="{{ $c->kode_kelas }}"
                            {{ $c->kode_kelas == $curriculum->id_kelas ? 'selected' : '' }}>
                            {{ $c->nm_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>File Kurikulum : <a href="{{ Storage::url('public/kurikulum/' . $curriculum->file_kurikulum) }}">
                    {{ $curriculum->file_kurikulum }}</a>
            </label>
            <input type="file" name="file_kurikulum" value="" class="form-control">
        </div>

        <div class="form-group">
            <label>Keterangan <label class="text-danger">(Opsional) :</label></label>
            <textarea name="keterangan" class="form-control" rows="3">{{ $curriculum->keterangan }}</textarea>
        </div>

        <div class="form-group text-right">
            <a href="{{ route('index-kurikulum') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i>
                Kembali</a>
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

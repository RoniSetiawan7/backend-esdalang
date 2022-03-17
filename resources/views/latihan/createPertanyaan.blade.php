@extends('layouts.form')

@section('form')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left text-center">
            <h2>Tambah Soal Latihan</h2>
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

<form action="{{ route('storePertanyaan') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label>Mata Pelajaran :</label>
        <select class="form-control" name="id_materi">
            <option value="">Pilih Mata Pelajaran</option>
            @foreach ($subject as $sub)
                @if (old('id_materi') == $sub->kode_materi)
                    <option value="{{ $sub->kode_materi }}" selected>{{ $sub->kode_materi }} -
                        {{ $sub->nm_materi }}</option>
                @else
                    <option value="{{ $sub->kode_materi }}">{{ $sub->kode_materi }} - {{ $sub->nm_materi }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Keterangan Gambar <label class="text-danger">(Opsional) :</label></label>
        <input type="file" name="ket_gambar" class="form-control">
    </div>

    <div class="form-group">
        <label>Soal :</label>
        <textarea name="soal" id="summernote" class="form-control" rows="3">{{ old('soal') }}</textarea>
    </div>

    <div class="form-group">
        <label>Jawaban Benar:</label>
        <input type="text" name="jawaban_benar" value="{{ old('jawaban_benar') }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Jawaban Salah Ke-1 :</label>
        <input type="text" name="jawaban_salah_1" value="{{ old('jawaban_salah_1') }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Jawaban Salah Ke-2 :</label>
        <input type="text" name="jawaban_salah_2" value="{{ old('jawaban_salah_2') }}" class="form-control">
    </div>

    <div class="form-group">
        <label>Jawaban Salah Ke-3 :</label>
        <input type="text" name="jawaban_salah_3" value="{{ old('jawaban_salah_3') }}" class="form-control">
    </div>

    <div class="form-group text-right">
        <a href="{{ route('finishLatihanPertanyaan') }}" class="btn btn-success"></i>Selesai</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>

    <!-- SummerNote -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    spellCheck: false,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            });
        </script>
        <style>
            .note-editable {
                background-color: white;
                color: black;
            }

        </style>
    @endpush

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

        <script>
            $(function() {
                @if (Session::has('success'))
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 2000 })
                @endif
            });
        </script>
    @endpush
</form>
@endsection

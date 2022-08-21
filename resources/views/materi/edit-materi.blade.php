@extends('layouts.form')

@section('form')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.css" rel="stylesheet">
@endsection

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left text-center">
            <h2>Edit Data Materi</h2>
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

<form action="{{ route('update-materi', $subject->kode_materi) }}" method="POST" autocomplete="off"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Kode Materi :</label>
            <input type="text" name="kode_materi" value="{{ $subject->kode_materi }}" readonly
                class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>Nama Materi :</label>
            <input type="text" name="nm_materi" value="{{ $subject->nm_materi }}" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label>Bab Materi:</label>
            <input type="text" name="bab" value="{{ $subject->bab }}" class="form-control">
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Nama Guru Pengampu :</label>
            <select class="form-control" name="id_guru">
                <option value="">Pilih Guru</option>
                @foreach ($teacher as $t)
                    <option disable="true" value="{{ $t->nip }}"
                        {{ $t->nip == $subject->id_guru ? 'selected' : '' }}>
                        {{ $t->nm_guru }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label>Kelas :</label>
            <select class="form-control" name="id_kelas">
                <option value="">Pilih Kelas</option>
                @foreach ($class as $c)
                    <option disable="true" value="{{ $c->kode_kelas }}"
                        {{ $c->kode_kelas == $subject->id_kelas ? 'selected' : '' }}>
                        {{ $c->nm_kelas }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label>Isi Materi :</label>
        <textarea name="isi_materi" id="summernote" class="form-control" rows="3">{{ $subject->isi_materi }}</textarea>
    </div>

    <div class="form-group text-right">
        <a href="{{ route('index-materi') }}" class="btn btn-default"><i class="fas fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </div>

    <!-- SummerNote -->
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.js"></script>
        <script src="{{ asset('js/summernote-math.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#summernote').summernote({
                    spellCheck: false,
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video', 'math']],
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
    @endpush

</form>
@endsection

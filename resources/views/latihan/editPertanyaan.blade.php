@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Edit Soal Latihan</h2>
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

    <form action="{{ route('updatePertanyaan', $qs->id) }}" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Mata Pelajaran :</label>
            <select class="form-control" name="id_materi">
                <option value="">Pilih Mata Pelajaran</option>
                @foreach ($subject as $sub)
                    <option disable="true" value="{{ $sub->kode_materi }}"
                        {{ $sub->kode_materi == $qs->id_materi ? 'selected' : '' }}>
                        {{ $sub->kode_materi }} - {{ $sub->nm_materi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Soal :</label>
            <textarea name="soal" class="ckeditor form-control" rows="3">{{ $qs->soal }}</textarea>
        </div>

        <div class="form-group">
            <label>Keterangan Gambar <label class="text-danger">(Opsional) :</label>
                {{ $qs->ket_gambar }}</label>
            <input type="file" name="ket_gambar" class="form-control">
            <br>
            <img src="{{ Storage::url('public/latihan/' . $qs->ket_gambar) }}" width="300px">
        </div>

        <div class="form-group">
            <label>Jawaban Benar:</label>
            <input type="text" name="jawaban_benar" value="{{ $qs->jawaban_benar }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Jawaban Salah Ke-1 :</label>
            <input type="text" name="jawaban_salah_1" value="{{ $qs->jawaban_salah_1 }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Jawaban Salah Ke-2 :</label>
            <input type="text" name="jawaban_salah_2" value="{{ $qs->jawaban_salah_2 }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Jawaban Salah Ke-3 :</label>
            <input type="text" name="jawaban_salah_3" value="{{ $qs->jawaban_salah_3 }}" class="form-control">
        </div>

        <div class="form-group text-right">
            <a href="{{ route('detailLatihanPertanyaan', $qs->id_latihan) }}" class="btn btn-default"><i
                    class="fas fa-arrow-left"></i>
                Kembali</a>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </div>

        <!-- CKEditor -->
        @push('scripts')
            <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('ckeditor');
            </script>
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

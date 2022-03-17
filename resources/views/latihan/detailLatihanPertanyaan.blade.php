@extends('layouts.form')

@section('form')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left text-center">
                <h2>Latihan : {{ $ex->nm_latihan }}</h2>
            </div>
        </div>
    </div>

    <div style="float: right">
        <a href="{{ route('indexLatihan') }}" class="btn btn-default btn-sm mr-1"><i class="fas fa-arrow-left"></i>
            Kembali</a>
        <a href="{{ route('editLatihan', $ex->kode_latihan) }}" class="btn btn-outline-info btn-sm mr-1">Edit</a>
        <a href="{{ route('deleteLatihan', $ex->kode_latihan) }}" class="btn btn-outline-info btn-sm"
            onclick="return confirm('Yakin ingin menghapus latihan {{ $ex->nm_latihan }}?')">Hapus</a>
    </div>
    <br>
    <hr>

    <div class="container">
        @php  $i=1;   @endphp

        @foreach ($qs as $q)
            <b>Soal Nomor {{ $i }} </b>{!! $q->soal !!}
            @php $i++;  @endphp

            <div class="row clearfix">
                <div class="col-5 ml-5"><b>Correct :</b> {{ $q->jawaban_benar }}</div>
                <div class="col-5"><b>Incorrect 2 :</b> {{ $q->jawaban_salah_2 }}</div>
            </div>

            <div class="row mb-3 my-1">
                <div class="col-5 ml-5"><b>Incorrect 1 :</b> {{ $q->jawaban_salah_1 }}</div>
                <div class="col-5"><b>Incorrect 3 :</b> {{ $q->jawaban_salah_3 }}</div>
            </div>

            <div style="float: right">
                <a href="{{ route('editPertanyaan', $q->id) }}" class="btn btn-outline-info btn-sm mr-1">Edit</a>
                <a href="{{ route('deletePertanyaan', $q->id) }}" class="btn btn-outline-info btn-sm"
                    onclick="return confirm('Yakin ingin menghapus soal nomor {{ $i }}?')">Hapus</a>
            </div>

            <div class="clearfix">
            </div>
        @endforeach

        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-outline-info btn-sx mr-2 mb-5 mt-3" style="width: 200px"><a
                    href="{{ route('addMorePertanyaan', $ex->kode_latihan) }}" class="btn-sm"
                    style="text-decoration: none">Tambah
                    Pertanyaan</a></button>
        </div>
    </div>

    <!-- Sweet Alert -->
    @push('scripts')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

@endsection

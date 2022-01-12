@extends('layouts.admin')

@section('main-content')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@endsection

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kurikulum</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <a href="{{ route('create-kurikulum') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i>
            Tambah Data</a>
    </div>
</div>

<div class="card border-left-danger shadow h-100 py-2">
    <div class="card-body">
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Materi :</label>
            <select id="filterMateri" class="form-control" style="width: 200px">
                <option value="">Semua Materi</option>
                @foreach ($filterSubject as $sub)
                    <option value="{{ $sub->nm_materi }}">{{ $sub->nm_materi }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Kelas :</label>
            <select id="filterKelas" name="id_kelas" class="form-control" style="width: 200px">
                <option value="">Semua Kelas</option>
                @foreach ($class as $c)
                    <option value="{{ $c->nm_kelas }}">{{ $c->nm_kelas }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div><br>

<div class="card shadow mb-4 border-left-danger shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">
            <i class="fas fa-list-ol text-gray-500"></i> Data Kurikulum
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataKurikulum" class="display">
                <thead>
                    <tr align="center">
                        <th>Kode Kurikulum</th>
                        <th>Nama Materi</th>
                        <th>Kelas</th>
                        <th>File Kurikulum</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($curriculum as $c)
                        <tr align="center">
                            <td>{{ $c->kode_kurikulum }}</td>
                            <td>{{ $c->getMateri['nm_materi'] }}</td>
                            <td>{{ $c->getKelas['nm_kelas'] }}</td>
                            <td><a href="{{ Storage::url('public/kurikulum/' . $c->file_kurikulum) }}">
                                    Lihat Kurikulum
                                </a>
                            </td>
                            <td>{{ $c->keterangan }}</td>
                            <td align="right">
                                <a href="{{ route('edit-kurikulum', $c->kode_kurikulum) }}"
                                    class="btn btn-warning btn-sm" role="button"><i class="far fa-edit"></i></a>
                                <a href="{{ route('destroy-kurikulum', $c->kode_kurikulum) }}"
                                    class="btn btn-danger btn-sm" role="button"
                                    onclick="return confirm('Yakin ingin menghapus data {{ $c->kode_kurikulum }}?')"><i
                                        class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Data Table -->
            @push('scripts')
                <script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var table = $('#dataKurikulum').DataTable();

                        $('#filterMateri').on('change', function() {
                            table.columns(1).search(this.value).draw();
                        });
                        $('#filterKelas').on('change', function() {
                            table.columns(2).search(this.value).draw();
                        });
                    });
                </script>
            @endpush

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

        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('main-content')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@endsection

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Guru</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <a href="{{ route('create-guru') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Tambah
            Data</a>
    </div>
</div>

<div class="card shadow mb-4 border-left-warning shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-chalkboard-teacher text-gray-500"></i> Data Guru
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataGuru" class="display" style="width:100%">
                <thead>
                    <tr align="center">
                        <th>NIP</th>
                        <th>Nama Guru</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($teacher as $t)
                        <tr align="center">
                            <td>{{ $t->nip }}</td>
                            <td>{{ $t->nm_guru }}</td>
                            <td>{{ $t->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $t->alamat }}</td>
                            <td>{{ $t->no_telp }}</td>
                            <td align="right">
                                <a href="{{ route('edit-guru', $t->nip) }}" class="btn btn-warning btn-sm"
                                    role="button"><i class="far fa-edit"></i></a>
                                <a href="{{ route('destroy-guru', $t->nip) }}" class="btn btn-danger btn-sm"
                                    role="button"
                                    onclick="return confirm('Yakin ingin menghapus data {{ $t->nm_guru }}?')"><i
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
                        var table = $('#dataGuru').DataTable();
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

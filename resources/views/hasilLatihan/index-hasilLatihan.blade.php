@extends('layouts.admin')

@section('main-content')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@endsection

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Hasil Latihan Siswa</li>
    </ol>
</nav>

<div class="card border-left-secondary shadow h-100 py-2">
    <div class="card-body">
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Nama Siswa :</label>
            <select id="filterNis" class="form-control" style="width: 200px">
                <option value="">Semua Siswa</option>
                @foreach ($student as $s)
                    <option value="{{ $s->nis }}">{{ $s->nm_siswa }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Kode Latihan :</label>
            <select id="filterKodeLatihan" class="form-control" style="width: 200px">
                <option value="">Semua Kode Latihan</option>
                @foreach ($exercise as $e)
                    <option value="{{ $e->kode_latihan }}">{{ $e->kode_latihan }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div><br>

<div class="card shadow mb-4 border-left-secondary shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">
            <i class="fas fa-check text-gray-500"></i> Data Hasil Latihan Siswa
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="datahasilLatihanSiswa" class="display" style="width:100%">
                <thead>
                    <tr align="center">
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kode Latihan</th>
                        <th>Nilai</th>
                        <th>Dikerjakan Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($result as $r)
                        <tr align="center">
                            <td>{{ $r->getSiswa['nis'] }}</td>
                            <td>{{ $r->getSiswa['nm_siswa'] }}</td>
                            <td>{{ $r->getLatihan['kode_latihan'] }}</td>
                            <td>{{ $r->nilai }}</td>
                            <td>{{ date_format($r->created_at, 'd M Y - H:i') }}</td>
                            <td align="right">
                                <a href="{{ route('show-hasilLatihan', $r->id) }}" class="btn btn-info btn-sm"
                                    role="button"><i class="far fa-eye"></i></a>
                                <a href="{{ route('destroy-hasilLatihan', $r->id) }}" class="btn btn-danger btn-sm"
                                    role="button"
                                    onclick="return confirm('Yakin ingin menghapus data {{ $r->getSiswa['nis'] }}?')"><i
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
                        var table = $('#datahasilLatihanSiswa').DataTable();

                        $('#filterNis').on('change', function() {
                            table.columns(0).search(this.value).draw();
                        });
                        $('#filterKodeLatihan').on('change', function() {
                            table.columns(1).search(this.value).draw();
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

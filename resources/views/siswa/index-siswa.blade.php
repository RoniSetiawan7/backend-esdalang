@extends('layouts.admin')

@section('main-content')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
@endsection

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
    </ol>
</nav>


<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <a href="{{ route('create-siswa') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Tambah
            Data</a>
    </div>
</div>

<div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Kelas :</label>
            <select id="filterKelas" class="form-control" style="width: 200px">
                <option value="">Semua Kelas</option>
                @foreach ($class as $c)
                    <option value="{{ $c->nm_kelas }}">{{ $c->nm_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group d-inline-block col-auto">
            <label class="font-weight-bold">Pilih Sub Kelas :</label>
            <select id="filterSubKelas" class="form-control" style="width: 200px">
                <option value="">Semua Sub Kelas</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
                <option value="E">E</option>
            </select>
        </div>
    </div>
</div><br>

<div class="card shadow mb-4 border-left-info shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-users text-gray-500"></i> Data Siswa
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataSiswa" class="display" style="width:100%">
                <thead>
                    <tr align="center">
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Kelas</th>
                        <th>Sub Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($student as $s)
                        <tr align="center">
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->nm_siswa }}</td>
                            <td>{{ $s->jk == 'L' ? 'Laki-laki' : ($s->jk == 'P' ? 'Perempuan' : '') }}</td>
                            <td>{{ $s->getKelas['nm_kelas'] }}</td>
                            <td>{{ $s->sub_kelas }}</td>
                            <td align="right">
                                <a href="{{ route('show-siswa', $s->nis) }}" class="btn btn-info btn-sm"
                                    role="button"><i class="far fa-eye"></i></a>
                                <a href="{{ route('edit-siswa', $s->nis) }}" class="btn btn-warning btn-sm"
                                    role="button"><i class="far fa-edit"></i></a>
                                <a href="{{ route('destroy-siswa', $s->nis) }}" class="btn btn-danger btn-sm"
                                    role="button"
                                    onclick="return confirm('Yakin ingin menghapus data {{ $s->nm_siswa }}?')"><i
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
                        var table = $('#dataSiswa').DataTable();

                        $('#filterKelas').on('change', function() {
                            table.columns(3).search(this.value).draw();
                        });
                        $('#filterSubKelas').on('change', function() {
                            table.columns(4).search(this.value).draw();
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
                                timer: 2000
                            })
                        @endif
                    });
                </script>
            @endpush

        </div>
    </div>
</div>
@endsection

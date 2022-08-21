@extends('layouts.admin')

@section('main-content')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Latihan</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12 margin-tb mb-3">
        <a href="{{ route('createLatihan') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Tambah
            Latihan</a>
    </div>
</div>

<div class="card shadow mb-4 border-left-success shadow h-100 py-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-question text-gray-500"></i> Data Latihan
        </h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="dataLatihan" class="display" style="width:100%">
                <thead>
                    <tr align="center">
                        <th>Kode Latihan</th>
                        <th>Nama Latihan</th>
                        <th>Kelas</th>
                        <th>Guru Pangampu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ex as $e)
                        <tr align="center">
                            <td>{{ $e->kode_latihan }}</td>
                            <td>{{ $e->nm_latihan }}</td>
                            <td>{{ $e->getKelas['nm_kelas'] }}</td>
                            <td>{{ $e->getGuru['nm_guru'] }}</td>
                            <td>
                                <input type="checkbox" data-id="{{ $e->kode_latihan }}" name="status"
                                    class="js-switch" {{ $e->status == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <a href="{{ route('detailLatihanPertanyaan', $e->kode_latihan) }}"
                                    class="btn btn-info btn-sm" role="button"><i class="far fa-eye"></i> Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Toogle Button Update Status Latihan -->
            @push('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                <script>
                    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                    elems.forEach(function(html) {
                        let switchery = new Switchery(html, {
                            size: 'small'
                        });
                    });

                    $(document).ready(function() {
                        $('.js-switch').change(function() {
                            let status = $(this).prop('checked') === true ? 1 : 0;
                            let latihanId = $(this).data('id');
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: '{{ route('latihan.update.status') }}',
                                data: {
                                    'status': status,
                                    'kode_latihan': latihanId
                                },
                                success: function(data) {
                                    toastr.options.closeButton = true;
                                    toastr.options.closeMethod = 'fadeOut';
                                    toastr.options.closeDuration = 2000;
                                    toastr.success(data.message);
                                }
                            });
                        });
                    });
                </script>
            @endpush

            <!-- Data Table -->
            @push('scripts')
                <script src="//cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function() {
                        var table = $('#dataLatihan').DataTable();
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

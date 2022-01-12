@extends('layouts.admin')

@section('main-content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Materi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('index-materi') }}" style="text-decoration:none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary mb-1">
                                    DATA MATERI
                                    <?php
                                    $materi = DB::table('materi')->count();
                                    ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $materi }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Soal Latihan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('indexLatihan') }}" style="text-decoration:none">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success mb-1">
                                    DATA LATIHAN
                                    <?php
                                    $latihan = DB::table('latihan')->count();
                                    ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $latihan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-question fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Data Siswa -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('index-siswa') }}" style="text-decoration:none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info mb-1">
                                    DATA SISWA
                                    <?php
                                    $siswa = DB::table('siswa')->count();
                                    ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $siswa }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Data Guru -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('index-guru') }}" style="text-decoration:none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning mb-1">
                                    DATA GURU
                                    <?php
                                    $guru = DB::table('guru')->count();
                                    ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $guru }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <!-- Kurikulum -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('index-kurikulum') }}" style="text-decoration:none">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger mb-1">
                                    DATA KURIKULUM
                                    <?php
                                    $kurikulum = DB::table('kurikulum')->count();
                                    ?></div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kurikulum }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-list-ol fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
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
                        title: 'Login Berhasil',
                        text: '{{ Session::get('success') }}',
                        })
                    @endif
                });
            </script>
        @endpush

    @section('footer')
    @endsection

</div>
@endsection

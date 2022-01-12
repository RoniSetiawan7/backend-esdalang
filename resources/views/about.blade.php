@extends('layouts.admin')

@section('main-content')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </nav>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="square" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold" align="center">Admin Esdalang App SMP Negeri 2 Kemalang</h5>
                            <p>Website ini dapat digunakan oleh admin / guru dengan tujuan untuk melakukan proses manajemen
                                konten aplikasi Esdalang App di SMP Negeri 2 Kemalang.</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>Thanks to :</p>
                            <a href="https://github.com/aleckrh/laravel-sb-admin-2" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection

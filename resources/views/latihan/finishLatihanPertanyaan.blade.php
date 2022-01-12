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
        <a href="{{ route('indexLatihan') }}" class="btn btn-info-outlined btn-sm"><i class="fas fa-arrow-left"></i>
            List Latihan</a>
    </div>
    <br>
    <hr>

    <div class="container">
        @php  $i=1;   @endphp

        @foreach ($qs as $q)
            <b>{{ $i }}. </b><label for="question">. {!! $q->soal !!}</label>
            @php $i++;  @endphp

            <div class="row clearfix">
                <div class="col-5 ml-5"><b>Correct :</b> {{ $q->jawaban_benar }}</div>
                <div class="col-5"><b>Incorrect 2 :</b> {{ $q->jawaban_salah_2 }}</div>
            </div>

            <div class="row mb-3 my-1">
                <div class="col-5 ml-5"><b>Incorrect 1 :</b> {{ $q->jawaban_salah_1 }}</div>
                <div class="col-5"><b>Incorrect 3 :</b> {{ $q->jawaban_salah_3 }}</div>
            </div>

            <br>

        @endforeach
    </div>

@endsection

@extends('layouts.guest')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card mx-auto">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 text-center mb-2">
                        <img src="{{ asset('res/assets/img/crest.png') }}" alt="MOF Logo" style="max-width: 120px">
                    </div>
                    <div class="col-md-12 text-center mb-2">
                        <h2 style="font-size: 12px;">Kementerian Kewangan Malaysia</h2>
                    </div>
                    <div class="col-md-12 text-center mb-2">
                        <img src="{{ asset('res/assets/img/logo-dark.png') }}" alt="SiPAD Logo" style="max-width: 350px">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-12 text-center">
                        <div class="alert alert-success" role="alert">
                            Sila semak email anda untuk mendapatkan cara-cara untuk set semula Google
                            Authenticator.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <div class="col-md-6">
                    <h2 style="font-size: 12px; color:#3a0064;">All Rights Reserved by BKSK</h2>
                </div>
                <div class="col-md-6 text-end">
                    <h2 style="font-size: 12px; color:#3a0064;">SiPAD v01</h2>
                </div>
            </div>
        </div>
    </div>
@endsection

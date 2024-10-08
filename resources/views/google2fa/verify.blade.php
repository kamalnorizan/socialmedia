@extends('layouts.guest')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card mx-auto" >
        <div class="card-body">
            <form method="POST" action="{{ route('google2fa.verify') }}">
                <div class="col-md-12 text-center mb-2">
                    <img src="{{ asset('res/assets/img/crest.png') }}" alt="MOF Logo"
                        style="max-width: 120px">
                </div>
                <div class="col-md-12 text-center mb-2">
                    <h2 style="font-size: 12px;">Kementerian Kewangan Malaysia</h2>
                </div>
                @csrf
                <div class="col-md-12 text-center mb-2">
                    <img src="{{ asset('res/assets/img/logo-dark.png') }}" alt="MOF Logo" style="max-width: 350px">
                </div>
                <div class="row mb-1">
                    <div class="col-md-12 text-center">
                        <div class="alert alert-info" role="alert">
                            Sila buka aplikasi Google Authenticator dan masukkan kod 6 digit yang diberikan.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-md-12">
                        <input id="one_time_password" type="one_time_password"
                            class="form-control @error('one_time_password') is-invalid @enderror" name="one_time_password"
                            required autocomplete="off" placeholder="One Time Password">

                        @error('one_time_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="trustThisDevice" id="trustThisDevice" value="1">
                            Trust This Device
                          </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-0">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            Hantar
                        </button>
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="{{ route('google2fa.sendmail') }}" class="btn btn-link">
                            Tidak memiliki Google Authenticator?
                        </a>
                    </div>

                </div>
            </form>
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

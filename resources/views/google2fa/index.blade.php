@extends('layouts.guest')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card mx-auto" style="width: 600px!important">
        <div class="card-header">2 Factor Authentication</div>

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
                <div class="row">
                    <div class="col-md-12">
                        Sila buka aplikasi Google Authenticator dan masukkan kod 6 digit yang diberikan.
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="one_time_password"
                        class="col-md-4 col-form-label text-md-end">One Time Password</label>

                    <div class="col-md-6">
                        <input id="one_time_password" type="one_time_password"
                            class="form-control @error('one_time_password') is-invalid @enderror" name="one_time_password"
                            required autocomplete="off">

                        @error('one_time_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Hantar
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

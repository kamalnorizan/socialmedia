@extends('layouts.guest')

@section('styles')
    <style>
        .qrcode {
            text-align: center;
            padding: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card mx-auto" style="width: 600px!important">
            <div class="card-body" style="text-align: center;">
                <p>Sediakan pengesahan dua faktor anda dengan mengimbas Kod QR di bawah. Sebagai alternatif, anda boleh menggunakan kod
                    <strong>{{ $secret }}</strong></p>
                <div class="qrcode">
                    {!! QrCode::size(250)->generate($QR_Image) !!}
                </div>
                <p>Anda mesti menyediakan aplikasi Google Authenticator di dalam telefon bimbit anda sebelum meneruskan. Sila muat turun aplikasi Google Authenticator di App Store / Play Store terlebih dahulu.
                </p>
                <p>
                    Klik butang dibawah sekiranya telah selesai mendaftar di Google Authenticator.
                </p>
                <div>
                    <a href="{{ route('complete.registration') }}" class="btn btn-primary">Teruskan Pendaftaran Google Authenticator</a>
                </div>
            </div>
        </div>

    </div>
@endsection

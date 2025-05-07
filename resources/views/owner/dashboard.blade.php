@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dashboard Owner</h2>
        <!-- Konten khusus Owner -->

        @if(Auth::user()->role === 'owner')
            <div class="alert alert-info">
                <a href="{{ route('register') }}" class="btn btn-primary">Registrasi Admin</a>
            </div>
        @endif
    </div>
@endsection

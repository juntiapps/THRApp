@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard Admin') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <div class="card text-center mb-3">
                                <div class='card-header'>
                                    Supported E-Wallet
                                </div>
                                <div class='card-body'>
                                    <h1>{{ $ewallet['count'] }}</h1>
                                </div>
                                <div class='card-footer'>
                                    <a href="{{ $ewallet['route'] }}">Detail</a>
                                </div>
                            </div>

                            <div class="card text-center mb-3">
                                <div class='card-header'>
                                    Pengguna
                                </div>
                                <div class='card-body'>
                                    <h1>{{ $user['count'] }}</h1>
                                </div>
                                <div class='card-footer'>
                                    <a href="{{ $user['route'] }}">Detail</a>
                                </div>
                            </div>

                            <div class="card text-center mb-3">
                                <div class='card-header'>
                                    Project
                                </div>
                                <div class='card-body'>
                                    <h1>{{ $project['count'] }}</h1>
                                </div>
                                <div class='card-footer'>
                                    <a href="{{ $project['route'] }}">Detail</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

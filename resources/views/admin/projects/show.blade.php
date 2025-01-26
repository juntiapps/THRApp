@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Detail') }}</div>

                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name" disabled
                                value="{{ old('name', $data->name) }}"><br><br>

                            <label for="url">URL:</label><br>
                            <input class="form-control" type="url" id="url" name="url" disabled
                                value="{{ old('url', $data->url) }}"><br><br>

                            <label for="url">QRCODE:</label><br>

                            @if (isset($data->qr))
                                <div class="mt-4 text-center">
                                    {!! $data->qr !!}
                                </div>
                            @endif
                            {{-- <button class="form-control btn btn-primary" type="submit">Submit</button> --}}
                            <a href="{{ route('projects.index') }}" class="form-control btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

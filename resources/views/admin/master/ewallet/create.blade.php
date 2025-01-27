@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tambah Ewallet') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('ewallet.store') }}" method="post">
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="color">Pilih Warna Tombol:</label><br>
                            <input type="color" id="color" name="color" value="{{ old('color', '#000000') }}">
                            @error('color')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <br><br>
                            <label for="color">Pilih Warna Label:</label><br>
                            <input type="color" id="color2" name="color2"
                                value="{{ old('color2', '#000000') }}"><br><br>
                            @error('color')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                            <br>
                            <button class="form-control btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('ewallet.index') }}" class="form-control btn btn-secondary mt-3">Batal</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

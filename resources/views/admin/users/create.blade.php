@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Tambah User') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('ewallet.store') }}" method="post">
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}"><br><br>
                            @error('name')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <label for="color">Pilih Warna:</label><br>
                            <input type="color" id="color" name="color" 
                                value="{{ old('color', '#000000') }}"><br><br>
                            @error('warna')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <button class="form-control btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

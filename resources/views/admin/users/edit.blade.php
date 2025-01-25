@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Ewallet') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div style="color: red;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('ewallet.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ old('name', $data->name) }}"><br><br>
                            @error('name')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <label for="color">Pilih Warna:</label><br>
                            <input type="color" id="color" name="color"
                                value="{{ old('color', $data->color) }}"><br><br>
                            @error('warna')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <button class="form-control btn btn-primary mb-3" type="submit">Submit</button>
                            <a href="{{ route('ewallet.index') }}" class="form-control btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

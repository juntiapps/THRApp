@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat Project Baru') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('u.projects.store') }}" method="post">
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input required class="form-control" type="text" id="name" name="name"
                                value="{{ old('name',session('name')) }}">
                            @error('name')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="shopee">URL Shopee Angpao/THR:</label><br>
                            <input class="form-control" type="text" id="shopee" name="shopee"
                                value="{{ old('shopee') }}">
                            @error('shopee')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                            <br>
                            <label for="dana">URL Dana Kaget:</label><br>
                            <input class="form-control" type="text" id="dana" name="dana"
                                value="{{ old('dana') }}">
                            @error('dana')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror
                            <br>

                            <label for="gopay">URL GoPay Angpao:</label><br>
                            <input class="form-control" type="text" id="gopay" name="gopay"
                                value="{{ old('gopay') }}">
                            @error('gopay')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- <div> --}}
                            <br><br>
                            <button class="form-control btn btn-primary mb-2" type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin membuat project ini?')">Submit</button>
                            <a href="{{ route('user_home') }}" class="form-control btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

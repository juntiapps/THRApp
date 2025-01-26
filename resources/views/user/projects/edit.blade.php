@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Project') }}</div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('u.projects.update',$data) }}" method="post">
                            @method('PUT')
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input required class="form-control" type="text" id="name" name="name"
                                value="{{ old('name',$data->name) }}"><br><br>
                            @error('name')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <label for="shopee">URL Shopee Angpao/THR:</label><br>
                            <input class="form-control" type="text" id="shopee" name="shopee"
                                value="{{ old('shopee',$data->shopee) }}"><br><br>
                            @error('shopee')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <label for="dana">URL Dana Kaget:</label><br>
                            <input class="form-control" type="text" id="dana" name="dana"
                                value="{{ old('dana',$data->dana) }}"><br><br>
                            @error('dana')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            <label for="gopay">URL GoPay Angpao:</label><br>
                            <input class="form-control" type="text" id="gopay" name="gopay"
                                value="{{ old('gopay',$data->gopay) }}"><br><br>
                            @error('gopay')
                                <div style="color: red;">{{ $message }}</div>
                            @enderror

                            {{-- <div> --}}

                            <button class="form-control btn btn-primary mb-2" type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin memperbarui project ini?')">Submit</button>
                            <a href="{{ route('user_home') }}" class="form-control btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

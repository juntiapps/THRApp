@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Detail') }}</div>

                    <div class="card-body">
                        <form action="" method="">
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name" disabled
                                value="{{ old('name', $data->name) }}"><br><br>

                            <label for="shopee">URL Shopee Angpao/THR:</label><br>
                            <input class="form-control" type="text" id="shopee" name="shopee" disabled
                                value="{{ old('shopee', $data->shopee) }}"><br><br>

                            <label for="dana">URL Dana Kaget:</label><br>
                            <input class="form-control" type="text" id="dana" name="dana" disabled
                                value="{{ old('dana',$data->dana) }}"><br><br>

                            <label for="gopay">URL GoPay Angpao:</label><br>
                            <input class="form-control" type="text" id="gopay" name="gopay" disabled
                                value="{{ old('gopay',$data->gopay) }}"><br><br>

                            <label for="url">URL:</label><br>
                            <input class="form-control" type="url" id="url" name="url" readonly
                                value="{{ old('url', $data->url) }}"><br><br>

                            <label for="url">QRCODE:</label><br>

                            @if (isset($data->qr))
                                <div class="mt-4 text-center">
                                    {!! $data->qr !!}
                                </div>
                            @endif
                            <br>
                            {{-- <button class="form-control btn btn-primary" type="submit">Submit</button> --}}
                            <a href="{{ route('user_home') }}" class="form-control btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

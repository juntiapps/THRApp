@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Setting') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="text-center mb-2">
                            <img src="{{ Auth::user()->avatar }}"
                                class="rounded-circle me-2 border border-2 border-primary p-1" width="120"
                                height="120">
                        </div>
                        <form action="" method="" id=detail>
                            @csrf
                            <label for="name">Nama:</label><br>
                            <input class="form-control" type="text" id="name" name="name"readonly
                                value="{{ old('name', $data->name) }}">

                            <label for="color">Email:</label><br>
                            <input class="form-control" type="email" id="name" name="name"readonly
                                value="{{ old('email', $data->email) }}"><br><br>

                            {{-- <button class="form-control btn btn-primary" type="submit">Submit</button> --}}
                        </form>

                        <form action="{{ route('u.destroy') }}" method="POST"
                            {{-- style="display: inline-block;" --}}
                            >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="form-control btn btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus Akun ini?')">
                                <i class="fas fa-trash"></i> Hapus Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel='stylesheet'>
    <link href="//cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css" rel='stylesheet'>
@endpush

@push('body')
    <script src="//code.jquery.com/jquery-3.7.1.js"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $('#projects').DataTable({
                responsive: true
            });
        });
    </script>
@endpush

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h5>Selamat Datang, <span style="font-weight:bold">{{ $data['name'] }}</span></h5>
                        <hr>
                        <div style="height: 20px"></div>
                        <a class="border border-primary rounded px-4 py-3" href="{{ route('u.projects.create') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                       <br><br>
                        <table class="table" id="projects">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['projects'] as $index => $item)
                                    <tr>
                                        <td> {{ $index + 1 }}</td>
                                        <td> {{ $item->name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('u.projects.show', $item->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('u.projects.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('u.projects.destroy', $item->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
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

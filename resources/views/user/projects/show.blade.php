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
                                value="{{ old('name', $data->name) }}"><br>

                            <label for="shopee">URL Shopee Angpao/THR:</label><br>
                            <input class="form-control" type="text" id="shopee" name="shopee" disabled
                                value="{{ old('shopee', $data->shopee) }}">
                            <p>Telah diklik : {{ $count['s'] }}</p>

                            <label for="dana">URL Dana Kaget:</label><br>
                            <input class="form-control" type="text" id="dana" name="dana" disabled
                                value="{{ old('dana', $data->dana) }}">
                            <p>Telah diklik : {{ $count['d'] }}</p>

                            <label for="gopay">URL GoPay Angpao:</label><br>
                            <input class="form-control" type="text" id="gopay" name="gopay" disabled
                                value="{{ old('gopay', $data->gopay) }}">
                            <p>Telah diklik : {{ $count['g'] }}</p>

                            {{-- <div class="form-check form-switch"> --}}
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{$filter_ip}}>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Filter IP Address</label>
                            {{-- </div> --}}
                            <br><br>

                            <label for="url">URL:</label><br>
                            <input class="form-control" type="url" id="url" name="url" readonly
                                value="{{ old('url', $data->url) }}"><br>

                            <label for="url">QRCODE:</label><br>

                            @if (isset($data->qr))
                                <div class="mt-4 text-center">
                                    <div id="qrcode" class="p-4 d-inline-block">
                                        <h3>{{ $data->name }}</h3>
                                        {!! $data->qr !!}
                                    </div>
                                    <br>
                                </div>
                            @endif
                            <br>
                            {{-- <button class="form-control btn btn-primary" type="submit">Submit</button> --}}
                        </form>
                        <button id="downloadBtn" class="form-control btn btn-success mb-2">Download QR Code (PNG)</button>
                        <button id="shareBtn" class="form-control btn btn-primary mb-2">Share QR Code</button>
                        <a href="{{ route('user_home') }}" class="form-control btn btn-secondary">Kembali</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body')
    <script src="//code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function dataURLToBlob(dataURL) {
            var parts = dataURL.split(';base64,');
            var contentType = parts[0].split(':')[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);
            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }
            return new Blob([uInt8Array], { type: contentType });
        }

        $(document).ready(function() {
            $('#downloadBtn').click(function() {
                html2canvas($('#qrcode')[0]).then(function(canvas) {
                    var link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'qrcode.png';
                    link.click();
                });
            });

            $('#shareBtn').click(function() {
                html2canvas($('#qrcode')[0]).then(function(canvas) {
                    canvas.toBlob(function(blob) {
                        var shareData = {
                            title: '{{ $data->name }} QR Code',
                            text: 'QR Code untuk {{ $data->name }}',
                        };

                        try {
                            var file = new File([blob], 'qrcode.png', { type: 'image/png' });
                            if (navigator.canShare && navigator.canShare({ files: [file] })) {
                                shareData.files = [file];
                                navigator.share(shareData).catch(function(err) {
                                    console.error('Share failed:', err);
                                    alert('Gagal melakukan share via API browser. Sedang membuka link copy fallback.');
                                    copyUrlFallback();
                                });
                                return;
                            }
                        } catch (e) {
                            console.warn('Web Share File API tidak tersedia', e);
                        }

                        if (navigator.share) {
                            shareData.url = $('#url').val();
                            navigator.share(shareData).catch(function(err) {
                                console.error('Share failed:', err);
                                alert('Share tidak berhasil, salin URL manual');
                            });
                        } else {
                            copyUrlFallback();
                        }
                    }, 'image/png');
                });
            });

            function copyUrlFallback() {
                var $url = $('#url');
                $url.prop('disabled', false).select();
                document.execCommand('copy');
                $url.prop('disabled', true);
                alert('URL QR telah disalin ke clipboard: ' + $('#url').val());
            }
        });
    </script>
@endpush

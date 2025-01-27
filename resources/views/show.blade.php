<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>THRApp</title>
    <meta name="description" content="Aplikasi THR">
    <meta name="keywords" content="thr,shopeepay,gopay,dana">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <style>
        .dana {
            color: #118ee9;
            font-weight: bold;
        }

        .gopay {
            color: #00AED6;
            font-weight: bold;
        }

        .shopee {
            color: #eb4d2d;
            font-weight: bold;
        }
    </style>
</head>
{{-- {{dd($data)}} --}}

<body class="antialiased">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/logo.jpg') }}" alt="">
                <h1 class="sitename"><span>THR</span>App</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/home') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Masuk</a></li>
                        @endauth
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>
    <main class="main">
        <section id="hero" class="hero section light-background">
            <div class="container position-relative p-5" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-5 text-center">
                    <h2>{{ $data->name }}</h2>

                    <p>Silakan Pilih Salah Satu</p>

                    @foreach ($data->ewallet as $item)
                        <a href="{{ $item->url }}" style="background-color:{{ $item->color }}; color:{{$item->color2}};" class="form-control">
                            {{ $item->ewallet_name }}</a>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <div class="container">
        <h2>{{ $data->title }}</h2>
    </div>
    <footer id="footer" class="footer light-background">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">JuntiApp</strong> <span>All Rights
                        Reserved</span></p>
            </div>

            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you've purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>

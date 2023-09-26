<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- CSS Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Fonts Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    {{-- MyCss --}}
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
    {{-- HEADER dan JUDUL --}}
    <section id="utama">
        <div class="row">
            <div class="col">
                <div id="header">
                    <div class="me-5">
                        @guest   
                            <a href="/login" class="btn btn-sm btn-warning">Login &nbsp;<i class="bi bi-box-arrow-in-right"></i></a>
                            @endguest
                        @auth
                            <a href="/dashboard" class="btn btn-sm btn-warning">Dashboard &nbsp;<i class="bi bi-speedometer2"></i></a>    
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="judul text-center my-4">
                    <h2>Welcome To My Blog</h2>
                </div>
            </div>
        </div>
    </section>
    {{-- Akhir HEADER dan JUDUL --}}

    {{-- Konten BLOG --}}
    <div class="row">
        <div class="col">
            <div class="konten">
                @foreach ($posts as $item)
                    
                    <div class="konten-kotak mb-3">
                        <a href="#" class="text-decoration-none stretched-link lh-sm">
                            <img src="{{ asset('storage/' . substr($item->thumb, 6)) }}" class="thumb" alt="Gambar Thumbnail">
                            <div class="konten-judul text-center">
                                <span class="text-dark">{{ $item->judul }}</span>
                            </div>
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    {{-- Akhir Konten BLOG --}}

    {{-- JS Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
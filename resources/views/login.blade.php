<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- Fonts Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    {{-- MyCSS --}}
    <link rel="stylesheet" href="../../css/style.css">
  </head>
  <body>
    {{-- ALERT --}}
    <div class="row">
        <div class="col d-flex justify-content-center">

            @if (session()->has('notregister'))
                <div class="peringatan">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        User Belum Aktif
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session()->has('gagal'))
                <div class="peringatan">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Username / Password Salah
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session()->has('keluar'))
                <div class="peringatan">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Anda telah Berhasil Logout
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

        </div>
    </div>
    {{-- AKHIR ALERT --}}

    {{-- MENU LOGIN --}}
    <section id="login" class="d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col">
                <div class="kotak-login">
                    <h2>Login</h2>
                    <hr style="border:1px solid white;">

                    <form action="/login" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label teks-login">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Your Username">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label teks-login">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-login">Login</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="/" class="kembali"><span class="fs-6">Back to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- AKHIR MENU LOGIN --}}

    
    {{-- JS Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
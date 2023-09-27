<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    {{-- Fonts Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600&display=swap" rel="stylesheet">
    {{-- TrixEditor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
    {{-- MyCSS --}}
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    {{-- HEADER dan JUDUL --}}
    <section id="utama">
        <div class="row">
            <div class="col">
                <div id="header">
                    <div class="me-5">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#logout">
                            Logout &nbsp;<i class="bi bi-box-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#buat">
                    <div class="judul-dash text-center mt-3 mb-4">
                        <h4><i class="bi bi-journal-plus"></i>&nbsp; Create Blog</h4>
                    </div>
                </button>
            
                @if (session()->has('suksestambah'))
                    <div class="alert alert-success alert-dismissible fade show d-inline-block" role="alert">
                        Data berhasil ditambahkan!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('suksesubah'))
                    <div class="alert alert-warning alert-dismissible fade show d-inline-block" role="alert">
                        Data berhasil diubah!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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
                        <img src="{{ asset('storage/' . substr($item->thumb, 6)) }}" class="thumb" alt="Gambar Thumbnail">
                        <div class="dash-judul">
                            <button type="button" class="btn d-block rounded-0 edit-button" data-bs-toggle="modal" data-bs-target="#ubah{{ $item->id }}">
                                <span class="fs-2 text-dark"><i class="bi bi-pencil-fill"></i></span>
                            </button>
                            <button type="button" class="btn d-block rounded-0 delete-button" data-bs-toggle="modal" data-bs-target="#hps{{ $item->id }}">
                                <span class="fs-2"><i class="bi bi-trash"></i></span>
                            </button>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    {{-- Akhir Konten BLOG --}}



    <!-- Modal BUAT BLOG BARU -->
    <div class="modal fade" id="buat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create New Blog</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/dashboard" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 1em 2em">
                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::User()->id }}">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg input-post @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" placeholder="New Blog's Title" autofocus required>
                        @error('judul')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-lg input-post @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Slug" readonly>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group input-post mb-2">
                                <input type="file" class="d-inline-block form-control" id="thumb" name="thumb" onchange="previewImage(thumb)" required>
                                <label class="input-group-text" for="thumb">Upload Thumbnail</label>
                            </div>
                            <img class="img-preview1 img-fluid mb-4">
                        </div>
                        <div class="col-6">
                            <div class="input-group input-post mb-2">
                                <input type="file" class="d-inline-block form-control" id="banner" name="banner" onchange="previewImage(banner)" required>
                                <label class="input-group-text" for="banner">Upload Banner</label>
                            </div>
                            <img class="img-preview2 img-fluid mb-4">
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="body" id="body" value="{{ old('body') }}">
                        <trix-editor input="body"></trix-editor>
                        @error('body')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>&nbsp; Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal HAPUS -->
    <div class="modal fade" id="hps{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal LOGOUT -->
    <div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Logout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda yakin mau Logout ???
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/logout">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
        </div>
    </div>
        

    {{-- JS Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Check Slug --}}
    <script>
        $('#judul').change(function(e) {
            $.get('{{ url('check_slug') }}', 
            { 'judul': $(this).val() }, 
            function( data ) {
                $('#slug').val(data.slug);
            }
            );
        });
    </script>
    {{-- Script TrixEditor --}}
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault;
        })
    
        function previewImage(gambar){
            console.log(gambar)
            const imgPreview1 = document.querySelector('.img-preview1');
            const imgPreview2 = document.querySelector('.img-preview2');
        
            imgPreview1.style.display = 'block';
            imgPreview2.style.display = 'block';
        
            const oFReader =  new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);
        
            oFReader.onload = function(oFREvent) {
                if(gambar == thumb){
                    imgPreview1.src = oFREvent.target.result;
                }else{
                    imgPreview2.src = oFREvent.target.result;
                }
            }
        }

        function previewTiga(){
            const gambar = document.querySelector('.thumb1');
            const imgPreview3 = document.querySelector('.img-preview3');
        
            imgPreview3.style.display = 'block';
        
            const oFReader =  new FileReader();
            oFReader.readAsDataURL(gambar.files[0]);
        
            oFReader.onload = function(oFREvent) {
                imgPreview3.src = oFREvent.target.result;
            }
        }

        function previewEmpat(){
            const gbr = document.querySelector('.banner1');
            const imgPreview4 = document.querySelector('.img-preview4');
        
            imgPreview4.style.display = 'block';
        
            const oFReader =  new FileReader();
            oFReader.readAsDataURL(gbr.files[0]);
        
            oFReader.onload = function(oFREvent) {
                imgPreview4.src = oFREvent.target.result;
            }
        }
    </script>
</body>
</html>
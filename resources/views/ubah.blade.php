<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="row">
        <div class="col">
            <div class="form-ubah">
                <div class="tombolx" onclick="tutup()"><i class="bi bi-x-circle"></i></div>

                <div class="pembungkus-form">
                    <div class="form-edit">
                        <form action="/dashboard/{{ $post[0]->id }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value="{{ $post[0]->user_id }}">
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-lg input-post @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul',$post[0]->judul) }}" placeholder="New Blog's Title" autofocus required>
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control form-control-lg input-post @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug',$post[0]->slug) }}" placeholder="Slug" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-post mb-2">
                                        <div class="d-none">
                                            <input type="file" class="d-inline-block form-control" id="thumb" name="thumb" onchange="previewImage(thumb)">
                                        </div>
                                        <label class="input-group-text tombol-gambar" for="thumb"><i class="bi bi-upload"></i>&nbsp; Upload Thumbnail</label>
                                    </div>
                                    <input type="hidden" name="oldThumb" id="oldThumb" value="{{ $post[0]->thumb }}">
                                    @if ($post[0]->thumb)  
                                        <img src="{{ asset('storage/' . substr($post[0]->thumb,6)) }}" class="img-preview1 img-fluid mb-4">
                                    @else  
                                        <img class="img-preview1 img-fluid mb-4">
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-post mb-2">
                                        <div class="d-none">
                                            <input type="file" class="d-inline-block form-control" id="banner" name="banner" onchange="previewImage(banner)">
                                        </div>
                                        <label class="input-group-text tombol-gambar" for="banner"><i class="bi bi-upload"></i>&nbsp; Upload Banner</label>
                                    </div>
                                    <input type="hidden" name="oldBanner" id="oldBanner" value="{{ $post[0]->banner }}">
                                    @if ($post[0]->banner)
                                        <img src="{{ asset('storage/' . substr($post[0]->banner,7)) }}" class="img-preview2 img-fluid mb-4">
                                    @else  
                                        <img class="img-preview2 img-fluid mb-4">
                                    @endif
                                </div>
                            </div>
                            <div>
                                <input type="hidden" name="body" id="body" value="{{ old('body',$post[0]->body) }}">
                                <trix-editor input="body"></trix-editor>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <div class="mt-4 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i>&nbsp; Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../../js/script.js"></script>
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
        document.addEventListener("trix-file-accept", function (e) {
            e.preventDefault;
        });

        // Preview IMAGE
        function previewImage(gambar) {
        console.log(gambar == document.querySelector('#thumb'));
        const imgPreview1 = document.querySelector(".img-preview1");
        const imgPreview2 = document.querySelector(".img-preview2");

        imgPreview1.style.display = "block";
        imgPreview2.style.display = "block";

        const oFReader = new FileReader();
        oFReader.readAsDataURL(gambar.files[0]);

        oFReader.onload = function (oFREvent) {
            if (gambar == document.querySelector('#thumb')) {
                imgPreview1.src = oFREvent.target.result;
            } else {
                imgPreview2.src = oFREvent.target.result;
            }
        };
    }
    </script>

    <script>
        function tutup(){
            let layar = document.querySelector('.form-ubah')
            layar.style.display = 'none'
        }
    </script>
</body>
</html>
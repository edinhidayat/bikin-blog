@extends('template')
@section('konten')

{{-- BANNER --}}
<div class="row">
    <div class="col-md">
        <div class="banner">
            <img src="{{ asset('storage/' . substr($post[0]->banner, 7)) }}" alt="Gambar Banner" class="img-fluid banner-gb">
        </div>
    </div>
</div>
{{-- AKHIR BANNER --}}

<div class="container mt-3 mb-0">
    <div class="row">
        <div class="col">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $post[0]->judul }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

{{-- isi BLOG --}}
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8 mb-3">
            <p><i class="bi bi-person-fill"></i> {{ $post[0]->user->nama }} &nbsp;&nbsp;<i class="bi bi-clock-fill"></i> {{ carbon\carbon::parse($post[0]->created_at)->translatedFormat('d-m-Y') }}</p>
            <h2 class="tampil-judul">{{ $post[0]->judul }}</h2>
            <p>{!! $post[0]->body !!}</p>
        </div>

        {{-- OTHER POST --}}
        <div class="col-lg-4 mb-4">
            <h5 class="tampil-other mb-0">Explore Other Post</h5>
            <hr class="mt-1">

            @foreach ($posts as $item)
            @if ($post->count() > 5)
                for($i = 1; $i < 6; $i++)
                <div class="post-other mb-3 border rounded p-1">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="thumbnail rounded-start">
                                    <img src="{{ asset('storage/' . substr($item[$i]->thumb, 6)) }}" alt="...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body pt-1 ps-2">
                                    <h5 class="card-title" style="font-size: 18px;">{{ $item[$i]->judul }}</h5>
                                    <p class="card-text" style="font-size: 12px;">{!! Str::limit(strip_tags($item[$i]->body), 60) !!}</p>
                                    <a href="/a/{{ $item[$i]->slug }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else  
                <div class="post-other mb-3 border rounded p-1">
                    <div class="card border-0">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <div class="thumbnail rounded-start">
                                    <img src="{{ asset('storage/' . substr($item->thumb, 6)) }}" alt="...">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body pt-1 ps-2">
                                    <h5 class="card-title" style="font-size: 18px;">{{ $item->judul }}</h5>
                                    <p class="card-text" style="font-size: 12px;">{!! Str::limit(strip_tags($item->body), 60) !!}</p>
                                    <a href="/a/{{ $item->slug }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach

        </div>
    </div>
</div>

{{-- AKHIR isi BLOG --}}

@endsection
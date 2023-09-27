@extends('template')
@section('konten')
    
{{-- HEADER dan JUDUL --}}
<section id="utama">
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
                    <a href="/a/{{ $item->slug }}" class="text-decoration-none stretched-link lh-sm">
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

<div class="container mb-4 mt-3">
    {{ $posts->links() }}
</div>
{{-- Akhir Konten BLOG --}}

@endsection
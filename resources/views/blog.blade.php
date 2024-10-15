@extends('Layout.client')
@section('content')
    @component('components.header', [
        'image_url' => $blogPage->image_url,
        'title' => $blogPage->title,
    ])
    @endcomponent

    @php
        $currentCategorySlug = request()->get('category'); // Mendapatkan slug kategori dari URL
    @endphp
    <div class="container">
        <section id="blog-details" class="blog-details section p-2">
            <div class="container">
                <article class="article px-lg-5">
                    <div class="content py-2 pt-0">
                        <h1 class="title text-center">{{ $blogPage->title }}</h1>
                        <p class="m-0 text-center">
                           {{ $blogPage->subtitle }}
                        </p>
                    </div><!-- End post content -->
                    <div class="tags-widget widget-item d-flex justify-content-center mt-2">
                        <ul class="list-unstyled d-flex flex-wrap justify-content-center">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="/blog?category={{ $category->slug }}{{ request()->has('search') ? '&search=' . request()->get('search') : '' }}"
                                        class="{{ $currentCategorySlug === $category->slug ? 'active-button' : '' }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-6 mx-auto">
                            <form class="w-100" action="/blog" method="GET">
                                @if (request()->has('category') && request()->get('category') !== '')
                                    <input type="hidden" name="category" value="{{ request()->get('category') }}">
                                @endif
                                <input class="form-control  border-1 border-black" type="search" name="search"
                                    placeholder="          Search and press Enter ⏎          " style="text-align: center;"
                                    aria-label="Search" autocomplete="off" required>
                            </form>
                        </div>
                    </div>
                </article>
                <section id="blog-posts" class="blog-posts section">
                    <div class="container">
                        @if (request()->has('category') || request()->has('search'))
                            <div class="">
                                @if (request()->has('category'))
                                    <p>
                                        🡦 Showing Posts with Category :
                                        <b>"{{ request()->get('category') }}"</b>
                                        <a href="javascript:void(0);" class="remove-category">⛔</a>
                                    </p>
                                @endif
                                @if (request()->has('search'))
                                    <p>
                                        🡦 Search Result :
                                        <b>"{{ request()->get('search') }}"</b>
                                        <a href="javascript:void(0);" class="remove-search">⛔</a>
                                    </p>
                                @endif
                            </div>
                        @endif
                        <div class="row gy-4">
                            @foreach ($posts as $post)
                                <div class="col-lg-3 rounded post-item">
                                    <a href="/blog/{{ $post->slug }}">
                                        <article class="rounded-custom">
                                            <div class="post-img" style="border-radius: 0.5rem 0.5rem 0 0; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid"
                                                    alt="" width="100%" style="height: 200px; object-fit: cover;">

                                            </div>
                                            <h4 class="text-truncate-2" style="overflow: hidden;">
                                                {{ Str::limit($post->title, 30) }}
                                            </h4>
                                            <small style="color: grey;">
                                                {{ $post->created_at->locale('id_ID')->format('l | d M Y') }}
                                            </small>
                                            <div class="content">
                                                <p class="text-truncate-2 mb-0" style="overflow: hidden;">
                                                    {{ Str::limit($post->excerpt, 70) }}
                                                </p>
                                            </div>
                                        </article>
                                    </a>
                                </div>
                            @endforeach
                        </div><!-- End blog posts list -->
                    </div>
                </section>
                <section id="blog-pagination" class="blog-pagination section">
                    <div class="container">
                        <div class="d-flex justify-content-center">
                            <ul>
                                {{-- Tombol Previous (Hilangkan jika di halaman pertama) --}}
                                @if (!$posts->onFirstPage())
                                    <li>
                                        <a href="{{ $posts->appends(request()->query())->previousPageUrl() }}">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Link Nomor Halaman --}}
                                @foreach ($posts->links()->elements[0] as $page => $url)
                                    @if ($page == $posts->currentPage())
                                        <li><a class="active" href="#">{{ $page }}</a></li>
                                    @else
                                        <li>
                                            <a href="{{ $posts->appends(request()->query())->url($page) }}">
                                                {{ $page }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Tambahan "..." jika ada lebih banyak halaman --}}
                                @if ($posts->lastPage() > 4)
                                    <li>...</li>
                                    <li>
                                        <a href="{{ $posts->appends(request()->query())->url($posts->lastPage()) }}">
                                            {{ $posts->lastPage() }}
                                        </a>
                                    </li>
                                @endif

                                {{-- Tombol Next (Hilangkan jika di halaman terakhir) --}}
                                @if ($posts->hasMorePages())
                                    <li>
                                        <a href="{{ $posts->appends(request()->query())->nextPageUrl() }}">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                // Hapus kategori dari URL
                $('.remove-category').click(function() {
                    let url = new URL(window.location.href);
                    url.searchParams.delete('category'); // Hapus parameter category
                    window.location.href = url.toString(); // Muat ulang halaman dengan URL yang diperbarui
                });

                // Hapus pencarian dari URL
                $('.remove-search').click(function() {
                    let url = new URL(window.location.href);
                    url.searchParams.delete('search'); // Hapus parameter search
                    window.location.href = url.toString(); // Muat ulang halaman dengan URL yang diperbarui
                });
            });
        </script>
    @endpush
    @component('components.contact', ['contacts' => $contacts, 'contactdetail' => $contactdetail])
    @endcomponent
@endsection

@section('meta')
    <title>{{ $header->site_name }}</title>
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />
@endsection

@section('header')
    @include('components.navbar', [
        'data' => $header,
    ])
@endsection

@section('footer')
    @include('components.footer', [
        'data' => $footer,
        'header' => $header,
        'sosmeds' => $sosmeds,
        'footer_links' => $footer_links,
    ])
@endsection

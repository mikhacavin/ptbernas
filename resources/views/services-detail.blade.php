@extends('Layout.client')
@section('content')
    @component('components.header', ['image_url' => $serviceItems->image_url, 'title' => $serviceItems->name])
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-0">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section pt-3">
                    {{-- <div class="container"> --}}
                    <article class="article p-lg-2">
                        <div class="content p-2 pt-0">
                            <h1 class="title text-center">{{ $serviceItems->name }}</h1>
                            <img src="{{ asset('storage/' . $serviceItems->image_url) }}" alt="" class="mb-3"
                                width="100%">
                            <p class="m-0">
                                {!! $serviceItems->desc !!}
                            </p>
                            <!-- ShareThis BEGIN -->
                        </div><!-- End post content -->
                        <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                    </article>
                    {{-- </div> --}}
                </section>
            </div>

            <div class="col-lg-4 sidebar">
                <div class="widgets-container">
                    <div class="container">
                        <h4>Another Service :</h4>
                        <div class="row row-cols-1 row-cols-md-1 g-3">
                            @foreach ($serviceItemsExcludeSlug as $serviceItem)
                                <div class="col">
                                    <a href="{{ route('servicesDetail', $serviceItem->slug) }}" class="card h-100 m-1 p-2"
                                        style="box-shadow: none; border-radius: 15px; border-width : 2px; border-color:black;
                                        transition: all 0.3s ease-in-out;"
                                        data-aos="zoom-out" data-aos-delay="100"
                                        onmouseover="this.style.boxShadow = '8px 8px  rgb(0, 0, 0)'; this.style.transform = 'translateY(-5px)';"
                                        onmouseout="this.style.boxShadow = 'none'; this.style.transform = 'translateY(0)';">
                                        <img src="{{ asset('storage/' . $serviceItem->icon_url) }}" alt=""
                                            width="60">
                                        <p class="fw-bold card-title">{{ $serviceItem->name }}</p>
                                        <p class="card-text">{{ $serviceItem->short_desc }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script type='text/javascript'
            src='https://platform-api.sharethis.com/js/sharethis.js#property=63b5067a132a8200194ace8c&product=inline-share-buttons'
            async='async'></script>
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

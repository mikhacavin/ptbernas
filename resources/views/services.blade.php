@extends('layout.client')
@section('content')
    @component('components.header', ['image_url' => $services->image_url, 'title' => $services->title])
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-2">
                    <div class="container">
                        <article class="article p-lg-5">
                            <div class="content py-2 pt-0">
                                <h1 class="title text-center">{{ $services->title }}</h1>
                                <p class="m-0">
                                    {!! $services->desc !!}
                                </p>
                            </div><!-- End post content -->
                        </article>
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-3 g-3">
                                @foreach ($serviceItems as $serviceItem)
                                    <div class="col">
                                        <a href="{{ route('servicesDetail', $serviceItem->slug) }}"
                                            class="card h-100 m-1 p-2"
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
                </section>
            </div>
        </div>
    </div>

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

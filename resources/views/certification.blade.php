@extends('layout.client')
@section('content')
    @component('components.header', [
        'image_url' => $certificationPage->image_url,
        'title' => $certificationPage->title,
    ])
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-2">
                    <div class="container">
                        <article class="article p-lg-5">
                            <div class="content py-2 pt-0">
                                <h1 class="title text-center">{{ $certificationPage->title }}</h1>
                                <p class="m-0 text-center">
                                    {{ $certificationPage->subtitle }}
                                </p>
                            </div><!-- End post content -->
                        </article>
                        <section id="testimonials" class="testimonials section">
                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                <div class="swiper init-swiper">
                                    <script type="application/json" class="swiper-config">
                              {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                  "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                  "el": ".swiper-pagination",
                                  "type": "bullets",
                                  "clickable": true
                                },
                                "breakpoints": {
                                  "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 40
                                  },
                                  "1200": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 1
                                  }
                                }
                              }
                            </script>
                                    <div class="swiper-wrapper">
                                        @foreach ($certification as $item)
                                            <div class="swiper-slide">
                                                <div class="testimonial-item-custom p-0">
                                                    <img src="{{ asset('storage/' . $item->image_url) }}" class=""
                                                        alt="" />
                                                    <small>{{ $item->title }}</small>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </section>
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

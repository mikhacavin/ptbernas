@extends('layout.client')
@section('content')
    @component('components.header', ['image_url' => $about->image_url, 'title' => $about->title])
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-2">
                    <div class="container">
                        <article class="article p-lg-5">
                            <div class="content py-2 pt-0">
                                <h1 class="title text-center">{{ $about->title }}</h1>
                                <p>
                                    {!! $about->desc !!}
                                </p>
                            </div><!-- End post content -->
                            <div class="container py-5" data-aos="fade-up" data-aos-delay="100">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-4 m-0 p-0 text-center text-white" style="background-color: #00439A;">
                                        <div class="p-3" data-aos="fade" data-aos-delay="200">
                                            <h3 class="text-white p-2">VISION</h3>
                                            <p class="fs-6">{{ $about->vision }}</p>
                                        </div>
                                    </div>
                                    <!-- End Info Item -->
                                    <div class="col-md-4 m-0 p-0 text-center text-white" style="background-color: #000000;">
                                        <div class="p-3" data-aos="fade" data-aos-delay="300">
                                            <h3 class="text-white p-2">MISSION</h3>
                                            <p class="fs-6 text-start">{!! nl2br($about->mission) !!}</p>
                                        </div>
                                    </div>
                                    <!-- End Info Item -->
                                </div>
                            </div>

                            <!-- Team Section -->
                            <section id="team" class="team section">

                                <!-- Section Title -->
                                <div class="container" data-aos="fade-up">
                                    <h2 class="title text-center">{{ $about->team_title }}</h2>
                                    <p class="text-center">{!! nl2br($about->team_desc) !!}</p>
                                </div><!-- End Section Title -->

                                <div class="container py-2">

                                    <div class="row gy-4">

                                        @foreach ($teams as $team)
                                            <div class="col-lg-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                                                <div class="team-member">
                                                    <div class="member-img">
                                                        <img src="{{ asset('storage/' . $team->image_url) }}"
                                                            class="img-fluid w-100" alt=""
                                                            style="object-fit: cover; object-position: top; height: 270px;">
                                                        <div class="social">
                                                            <a href=""><i class="bi bi-twitter-x"></i></a>
                                                            <a href=""><i class="bi bi-facebook"></i></a>
                                                            <a href=""><i class="bi bi-instagram"></i></a>
                                                            <a href=""><i class="bi bi-linkedin"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="member-info">
                                                        <h4>{{ $team->name }}</h4>
                                                        <span>{{ $team->title }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>

                            </section><!-- /Team Section -->

                        </article>
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

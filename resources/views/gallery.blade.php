@extends('Layout.client')
@section('content')
    @component('components.header', ['image_url' => $gallery->image_url, 'title' => $gallery->title])
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-2">
                    <div class="container">
                        @component('components.activity-gallery', [
                            'activities' => $activities,
                            'title' => $gallery->title,
                            'subtitle' => $gallery->subtitle,
                        ])
                        @endcomponent
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

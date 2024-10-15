@extends('layout.client')
@section('content')
    @component('components.hero', ['hero' => $hero, 'servicesItems' => $servicesItems])
    @endcomponent

    @component('components.client-slider', ['clients' => $clients])
    @endcomponent

    @component('components.about-us', ['about' => $about])
    @endcomponent

    @component('components.service', ['service' => $service, 'servicesItems' => $servicesItems])
    @endcomponent


    @component('components.usp', ['usp' => $usp])
    @endcomponent

    @component('components.project-stats', [
        'projects' => $projects,
        'title' => $social_media->title_projects,
        'subtitle' => $social_media->desc_projects,
    ])
    @endcomponent
    @component('components.portfolio-works', ['works' => $works, 'worksPage' => $worksPage])
    @endcomponent
    @component('components.gallery', ['activities' => $activities, 'activity' => $activity])
    @endcomponent
    @component('components.socialmedia', [
        'socials' => $socials,
        'title' => $social_media->title,
        'subtitle' => $social_media->subtitle,
    ])
    @endcomponent
    @component('components.testimonials', ['testimonials' => $testimonials, 'testimonial' => $testimonial])
    @endcomponent
    @component('components.recent-posts', ['posts' => $posts, 'postsPage' => $postsPage])
    @endcomponent
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
        'cs' => $cs,
        'menus' => $menus,
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

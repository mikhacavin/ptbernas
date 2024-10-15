@extends('layout.client')
@section('content')
    @component('components.header', ['image_url' => 'images/contactpage/qhWCWrk6zy-contact.png', 'title' => 'title'])
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-2">
                    <div class="container">
                        <div class="row  d-flex justify-content-center">
                            <div class="col-lg-6 my-5">
                                <div class="card" style="border-radius: 15px; overflow:hidden;">
                                    <div class="card-header bg-primary text-white text-center">
                                        <h4 class="text-white">Hello👋</h4>
                                        <p>Your opinion matters to us!</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title text-center">How was your experience? </p>
                                        <form action="/feedback" method="POST">
                                            @csrf
                                            <div class="form-group my-4">
                                                <div class="rating">
                                                    <input type="radio" id="rating5" name="rating" value="5">
                                                    <label for="rating5">☆</label>
                                                    <input type="radio" id="rating4" name="rating" value="4">
                                                    <label for="rating4">☆</label>
                                                    <input type="radio" id="rating3" name="rating" value="3">
                                                    <label for="rating3">☆</label>
                                                    <input type="radio" id="rating2" name="rating" value="2">
                                                    <label for="rating2">☆</label>
                                                    <input type="radio" id="rating1" name="rating" value="1">
                                                    <label for="rating1">☆</label>
                                                </div>
                                                <span
                                                    class="error-message text-danger">{{ $errors->first('rating') }}</span>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Your name" required style="border-color: #8c8c8c;"
                                                    value="{{ old('name') }}">
                                                <span class="error-message text-danger">{{ $errors->first('name') }}</span>
                                            </div>
                                            <div class="form-group mb-4">
                                                <input type="text" class="form-control" id="position" name="position"
                                                    placeholder="Jobs / Position" required style="border-color: #8c8c8c;"
                                                    value="{{ old('position') }}">
                                                <span
                                                    class="error-message text-danger">{{ $errors->first('position') }}</span>
                                            </div>
                                            <div class="form-group mb-4">
                                                <textarea class="form-control" id="message" name="message" placeholder="Leave your message.." required rows="5"
                                                    style="border-color: #8c8c8c;">{{ old('message') }}</textarea>
                                                <span
                                                    class="error-message text-danger">{{ $errors->first('message') }}</span>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-block btn-dark">Rate now</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @push('css')
        <style>
            .rate {
                border-bottom-right-radius: 12px;
                border-bottom-left-radius: 12px
            }

            .rating {
                display: flex;
                flex-direction: row-reverse;
                justify-content: center
            }

            .rating>input {
                display: none
            }

            .rating>label {
                position: relative;
                width: 1em;
                font-size: 30px;
                font-weight: 300;
                color: #FFD600;
                cursor: pointer
            }

            .rating>label::before {
                content: "\2605";
                position: absolute;
                opacity: 0
            }

            .rating>label:hover:before,
            .rating>label:hover~label:before {
                opacity: 1 !important
            }

            .rating>input:checked~label:before {
                opacity: 1
            }

            .rating:hover>input:checked~label:before {
                opacity: 0.4
            }

            .buttons {
                top: 36px;
                position: relative
            }
        </style>
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

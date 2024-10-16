@extends('layout.client')
@section('content')
    @component('components.header', ['image_url' => $contact->image_url, 'title' => $contact->page_title])
    @endcomponent
    <!-- Contact Section -->
    <section id="contact" class="contact section"
        style="
    background-image: url('{{ asset('assets/img/bg-contact.svg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  ">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <hr>
            <h2 class="pt-4 pb-5">{{ $contact->subtitle }}</h2>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 m-2 justify-content-center mb-5">
                <div class="col-lg-12">
                    <div class="row g-3">
                        <div class="col-md-3 d-flex align-items-stretch">
                            <div class="info-item w-100" data-aos="fade" data-aos-delay="200">
                                <i class="bi bi-geo-alt"></i>
                                <h3>{{ $contacts->address_title }}</h3>
                                <p>{{ $contacts->address_desc }}</p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-stretch">
                            <div class="info-item w-100" data-aos="fade" data-aos-delay="300">
                                <i class="bi bi-telephone"></i>
                                <h3>{{ $contacts->call_title }}</h3>
                                <p>{!! nl2br($contacts->call_desc) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-stretch">
                            <div class="info-item w-100" data-aos="fade" data-aos-delay="400">
                                <i class="bi bi-envelope"></i>
                                <h3>{{ $contacts->email_title }}</h3>
                                <p>{!! nl2br($contacts->email_desc) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-stretch">
                            <div class="info-item w-100" data-aos="fade" data-aos-delay="500">
                                <i class="bi bi-clock"></i>
                                <h3>{{ $contacts->open_title }}</h3>
                                <p>{!! nl2br($contacts->open_desc) !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-6 d-flex align-items-stretch">
                    <form action="" method="post" class="php-email-form-edit" data-aos="fade-up" data-aos-delay="200"
                        id="contact-form-submit-custom">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name"
                                    required="" />
                            </div>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email"
                                    required="" />
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject"
                                    required="" />
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" id="contact-btn-submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch">
                    <div style="width: 100%; height: 100%;">
                        {!! preg_replace(
                            '/width="\d+"/',
                            'width="100%"',
                            preg_replace('/height="\d+"/', 'height="100%"', $contacts->maps_embed),
                        ) !!}
                    </div>
                </div>
            </div>

        </div>
        @push('script')
            <script>
                $(document).ready(function() {

                    $.ajaxSetup({
                        headers: {

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('#contact-form-submit-custom').submit(function(e) {
                        e.preventDefault();
                        var url = '{{ route('contact.submit') }}';
                        var formData = new FormData(this);
                        $('#contact-btn-submit').attr('disabled', true).text('Loading..');
                        $.ajax({
                            type: 'POST',
                            url: url,
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                if (data.success) {
                                    $('#contact-btn-submit').attr('disabled', false).text(
                                        'Send Message');
                                    $('#contact-form-submit-custom')[0].reset();
                                    alert(data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                var errors = xhr.responseJSON.errors;
                                $('#contact-btn-submit').attr('disabled', false).text('Send Message');
                                alert(errors.message);
                            }
                        });
                    });

                });
            </script>
        @endpush
    </section>
    <!-- /Contact Section -->
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

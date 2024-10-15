<!-- Services/social media Section -->
<section id="services" class="services section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $title }}</h2>
        <p class="fs-6">{{ $subtitle }}</p>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row gy-4 d-flex justify-content-center">
            @foreach ($socials as $social)
                <div class="col-md-auto" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ $social->url }}" target="_blank">
                        <div class="service-item">
                            <div class="d-flex align-items-center justify-content-center">
                                <img src="{{ asset('storage/' . $social->image_url) }}" alt="" class="mx-2"
                                    width="35rem" />
                                <div>
                                    <h3 class="m-0 fw-semibold fs-6 align-items-bottom">
                                        {{ $social->title }}
                                    </h3>
                                    <div class="d-flex align-items-center">
                                        <h3 class="m-0 fw-bold fs-4">{{ $social->name }}</h3>
                                        <img src="assets/img/verfied.svg" alt="" class="p-1"
                                            width="35rem" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <!-- End Service Item -->
        </div>
    </div>
</section>
<!-- /Services Section -->

    <!-- Hero Section -->
    <section id="hero" class="hero section">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">
                        {{ $hero->title }}
                    </h1>
                    <p data-aos="fade-up" data-aos-delay="100">
                        {{ $hero->subtitle }}
                    </p>
                    <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                        <a href="#clients" class="btn-get-started mx-5 mx-md-0">Get Started &nbsp; &nbsp;
                            <i class="bi bi-arrow-down-right d-none d-md-block"></i>
                            <i class="bi bi-arrow-down d-block d-md-none"></i></a>
                        <a href="{{ $hero->video_url }}"
                            class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i
                                class="bi bi-play-circle"></i><span>Watch Video</span></a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <div class="swiper mySwiper swiper-widget">
                        <div class="swiper-wrapper">
                            @foreach ($servicesItems as $service)
                                <div class="swiper-slide"
                                    style="
                      background-image: url('{{ asset('storage/' . $service->image_url) }}');
                      background-size: cover;
                      background-position: center;
                      background-repeat: no-repeat;
                    ">
                                    <div class="text-center w-100" style="position: absolute; bottom: 0; background-color: rgba(0, 0, 0, 0.315); padding: 0.8rem;">
                                        <p class="text-white m-0">{{ $service->name }}</p>
                                        <small><a class="badge rounded-pill text-bg-light"
                                                href="service/{{ $service->slug }}">Detail</a></small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Hero Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $testimonial->title }}</h2>
                <p>{{ $testimonial->subtitle }}<br /></p>
            </div>
            <!-- End Section Title -->

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
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="stars">
                                        @for ($i = 1; $i <= $testimonial->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                    </div>
                                    <p>{{ $testimonial->desc }}</p>
                                    <div class="profile mt-auto">
                                        @if ($testimonial->clients)
                                            <img src="{{ asset('storage/' . $testimonial->clients->image_url) }}"
                                                class="testimonial-img" alt="" />
                                        @else
                                            <img src="https://www.svgrepo.com/show/327465/person-circle.svg"
                                                class="testimonial-img" alt="" />
                                        @endif
                                        <h3>{{ $testimonial->name }}</h3>
                                        <h4>{{ $testimonial->position }}</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
        <!-- /Testimonials Section -->

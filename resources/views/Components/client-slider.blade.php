      <!-- Clients Section -->
      <section id="clients" class="clients section bg-dark py-3 client-slider-section">
          <div class="container" data-aos="fade-up" data-aos-delay="100">
              {{-- <div class="swiper init-swiper" style="height: 10vh;">
                  <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 750,
                "autoplay": {
                "delay": 1800
                },
                "slidesPerView": "auto",
                "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
                },
                "breakpoints": {
                "320": {
                    "slidesPerView": 3,
                    "spaceBetween": 40
                },
                "480": {
                    "slidesPerView": 3,
                    "spaceBetween": 60
                },
                "640": {
                    "slidesPerView": 4,
                    "spaceBetween": 80
                },
                "992": {
                    "slidesPerView": 6,
                    "spaceBetween": 120
                }
                }
            }
            </script>
                  <div class="swiper-wrapper align-items-center" style="cursor: grab; user-select: none">
                      @foreach ($clients as $client)
                          <div class="swiper-slide custom-image-slide">
                              <img src="{{ asset('storage/' . $client->image_url) }}" class="img-fluid" alt="" />
                          </div>
                      @endforeach
                  </div>
              </div> --}}
              <swiper-container class="mySwiper" loop="true" autoplay-delay="1800" autoplay-disable-on-interaction="false"
                  grab-cursor="true" slides-per-view="auto" space-between="60">
                  @foreach ($clients as $client)
                      <swiper-slide class="custom-image-slide"><img src="{{ asset('storage/' . $client->image_url) }}"
                              alt="" /></swiper-slide>
                  @endforeach
              </swiper-container>
            </div>

      </section>
      <!-- /Clients Section -->

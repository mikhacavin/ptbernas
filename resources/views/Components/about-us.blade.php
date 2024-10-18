  <!-- About Section -->
  <section id="about" class="about section">
      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
          <!-- <h2>Our Values</h2> -->
          <h2 class="fw-bold">{{ $about->title }}</h2>
      </div>

      <div class="container" data-aos="fade-up">
          <div class="row">
              <div class="col-lg-4" data-aos="zoom-out" data-aos-delay="100">
                  <img src="{{ asset('storage/' . $about->image_url) }}" class="box-shadow-custom" alt=""
                      width="95%" />
              </div>
              <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                  <div class="content">
                      <!-- <h3>Who We Are</h3> -->
                      <p class="text-justify m-0">
                          {!! $about->short_desc !!}
                      </p>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="d-flex align-items-center">
                                  <img src="assets/img/vision.svg" alt="" width="36" class="m-1" />
                                  <h3 class="m-0">Clear Vision</h3>
                              </div>
                              <p class="text-start">{{ $about->vision }}</p>
                          </div>
                          <div class="col-lg-6">
                              <div class="d-flex align-items-center gap-1">
                                  <img src="assets/img/mission.svg" alt="" width="36" class="m-1" />
                                  <h3 class="m-0">Clear Mission</h3>
                              </div>
                              <p class="text-start">{!! nl2br($about->mission) !!}</p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="text-center">
                  <a href="/about"
                      class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                      <span>Read More</span>
                      <i class="bi bi-arrow-up-right"></i>
                  </a>
              </div>
          </div>
      </div>
  </section>
  <!-- /About Section -->

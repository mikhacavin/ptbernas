      <!-- Contact Section -->
      <section id="contact" class="contact section"
          style="
    background-image: url('assets/img/bg-contact.svg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  ">
          <!-- Section Title -->
          <div class="container section-title">
              <hr>
              <h2 class="pt-4 pb-5">{{ $contactdetail->name }} </h2>
          </div>
          <!-- End Section Title -->

          <div class="container">
              <div class="row gy-4 py-4">
                  <div class="col-lg-6">
                      <div class="row gy-4">
                          <div class="col-md-6">
                              <div class="info-item">
                                  <i class="bi bi-geo-alt"></i>
                                  <h3>{{ $contacts->address_title }}</h3>
                                  <p>{{ $contacts->address_desc }}</p>
                              </div>
                          </div>
                          <!-- End Info Item -->

                          <div class="col-md-6">
                              <div class="info-item">
                                  <i class="bi bi-telephone"></i>
                                  <h3>{{ $contacts->call_title }}</h3>
                                  <p>{!! nl2br($contacts->call_desc) !!}</p>
                              </div>
                          </div>
                          <!-- End Info Item -->

                          <div class="col-md-6">
                              <div class="info-item">
                                  <i class="bi bi-envelope"></i>
                                  <h3>{{ $contacts->email_title }}</h3>
                                  <p>{!! nl2br($contacts->email_desc) !!}</p>
                              </div>
                          </div>
                          <!-- End Info Item -->

                          <div class="col-md-6">
                              <div class="info-item">
                                  <i class="bi bi-clock"></i>
                                  <h3>{{ $contacts->open_title }}</h3>
                                  <p>{!! nl2br($contacts->open_desc) !!}</p>
                              </div>
                          </div>
                          <!-- End Info Item -->
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <form action="forms/contact.php" method="post" class="php-email-form">
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
                                  <div class="loading">Loading</div>
                                  <div class="error-message"></div>
                                  <div class="sent-message">
                                      Your message has been sent. Thank you!
                                  </div>

                                  <button type="submit">Send Message</button>
                              </div>
                          </div>
                      </form>
                  </div>
                  <!-- End Contact Form -->
              </div>
          </div>
      </section>
      <!-- /Contact Section -->

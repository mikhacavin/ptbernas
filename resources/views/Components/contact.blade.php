      <!-- Contact Section -->
      <section id="contact" class="contact section"
          style="
    background-image: url('{{ asset('assets/img/bg-contact.svg') }}');
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
                      <form action="" method="post" class="php-email-form-edit" id="contact-form-submit-custom">
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
                  <!-- End Contact Form -->
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
                                      $('#contact-btn-submit').attr('disabled', false).text('Send Message');
                                      $('#contact-form-submit-custom')[0].reset();
                                      alert('Message sent successfully');
                                  }
                              },
                              error: function(xhr, status, error) {
                                  var errors = xhr.responseJSON.errors;
                                  $('#contact-btn-submit').attr('disabled', false).text('Send Message');
                                  alert('something went wrong!',errors);
                              }
                          });
                      });

                  });
              </script>
          @endpush
      </section>
      <!-- /Contact Section -->

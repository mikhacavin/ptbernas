       <!-- Recent Posts Section -->
       <section id="recent-posts" class="recent-posts section">
           <!-- Section Title -->
           <div class="container section-title" data-aos="fade-up">
               <h2>{{ $postsPage->title }}</h2>
               <p>{{ $postsPage->subtitle }}</p>
           </div>
           <!-- End Section Title -->

           <div class="container">
               <div class="row gy-5">
                   @foreach ($posts as $post)
                       <div class="col-xl-3 col-md-6">
                           <a href="/blog/{{ $post->slug }}">
                               <div class="post-item position-relative h-100">
                                   <div class="post-img position-relative overflow-hidden">
                                       <img src="{{ asset('storage/' . $post->thumbnail) }}" class="img-fluid"
                                           alt="" style="width: 100%; height: 200px; object-fit: cover;" />
                                   </div>

                                   <div class="post-content d-flex flex-column">
                                       <h4 class="text-truncate-2" style="overflow: hidden;">
                                           {{ Str::limit($post->title, 30) }}
                                       </h4>

                                       <div class="meta d-flex align-items-center">
                                           <small style="color: grey;">
                                               {{ $post->created_at->locale('id_ID')->format('l | d M Y') }}
                                           </small>
                                       </div>
                                       <p class="text-truncate-2 mb-0" style="overflow: hidden;">
                                           {{ Str::limit($post->excerpt, 70) }}
                                       </p>
                                   </div>
                               </div>
                           </a>
                       </div>
                       <!-- End post item -->
                   @endforeach
               </div>
               <div class="d-flex justify-content-center text-center text-lg-start my-5">
                   <a href="/blog"
                       class="btn btn-dark btn-read-more d-inline-flex align-items-center justify-content-between px-3">
                       <span>Read More</span>
                       <i class="bi bi-arrow-up-right"></i>
                   </a>
               </div>
           </div>
       </section>
       <!-- /Recent Posts Section -->

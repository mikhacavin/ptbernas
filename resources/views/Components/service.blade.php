     <!-- Values / services Section -->
     <section id="values" class="values section"
         style="
   background-image: url('assets/img/bg-ocean.png');
   background-size: cover;
   background-position: center;
   background-repeat: no-repeat;
 ">
         <!-- Section Title -->
         <div class="container section-title" data-aos="fade-up">
             <h2 class="d-flex align-items-center justify-content-center">{{ $service->title }}&nbsp;<a href="/service"
                     class="btn btn-light btn-circle d-flex align-items-center justify-content-center bold">
                     <i class="bi bi-arrow-up-right" style="-webkit-text-stroke: 1px;"></i>
                 </a></h2>
             <p class="fs-6">
                 {{ $service->desc }}
             </p>
         </div>
         <!-- End Section Title -->

         <div class="container">
             <div class="row gy-4 justify-content-center">
                 @foreach ($servicesItems as $serviceItem)
                     <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                         <div class="card">
                             <div class="service-image">
                                 <img src="{{ asset('storage/' . $serviceItem->image_url) }}" class="img-fluid"
                                     alt="" />
                                 <a class="btn-getstarted flex-md-shrink-0"
                                     href="service/{{ $serviceItem->slug }}">Read more &nbsp; <i
                                         class="bi bi-arrow-up-right"></i></a>
                             </div>
                             <h3>{{ $serviceItem->name }}</h3>
                             <p>
                                 {{ $serviceItem->short_desc }}
                             </p>
                         </div>
                     </div>
                 @endforeach
                 <!-- End Card Item -->
             </div>
         </div>
     </section>
     <!-- /Values Section -->

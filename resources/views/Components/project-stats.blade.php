   <!-- Stats Section -->
   <section id="stats" class="stats section text-white bg-dark element-with-background-image"
       style="
 background-image: linear-gradient(
     rgba(0, 0, 0, 0.76),
     rgba(0, 0, 0, 0.76)
   ),
   url('assets/img/team-project.png');
 background-size: cover;
 background-position: center;
 background-repeat: no-repeat;
">
       <!-- Section Title -->
       <div class="container section-title" data-aos="fade-up">
           <h2 class="text-white">{{ $title }}</h2>
           <p class="fs-6 text-center text-white">{{ $subtitle }}</p>
       </div>
       <!-- End Section Title -->
       <div class="container" data-aos="fade-up" data-aos-delay="100">
           <div class="row gy-4">
               @foreach ($projects as $project)
                   <div class="col-lg-3 col-md-6">
                       <div class="stats-item w-100 h-100">
                           <div class="d-flex justify-content-center align-items-center">
                               <span data-purecounter-start="0" data-purecounter-end="{{ $project->number }}"
                                   data-purecounter-duration="1" class="purecounter text-white"></span>
                               <i class="bi bi-plus-lg fs-4 text-primary" style="-webkit-text-stroke: 2px"></i>
                           </div>
                           <p class="text-center">{{ $project->desc }}</p>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   </section>
   <!-- /Stats Section -->

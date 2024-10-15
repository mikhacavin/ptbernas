   <!-- Page Title -->
   <div class="page-title">
       <div class="heading" style="background-image: linear-gradient(rgba(0, 0, 0, 0.411), rgba(0, 0, 0, 0.2)), url('{{ asset('storage/' . $image_url) }}'); background-size: cover; background-position: center;">
           <div class="container py-5">
               <div class="row d-flex py-2">
                   <div class="col-lg-8">
                       <h1 class="text-white" style="text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);">{{ $title }}</h1>
                           <nav class="breadcrumbs" style="background-color: transparent;">
                               <ol class="p-0">
                                   <li class="text-white"><a href="/" class="text-white">HOME</a></li>
                                   <li class="current text-white" style="text-shadow: 2px 2px 2px rgba(0,0,0,0.2);">{{ $title }}</li>
                               </ol>
                           </nav>
                   </div>
               </div>
           </div>
       </div>
   </div><!-- End Page Title -->

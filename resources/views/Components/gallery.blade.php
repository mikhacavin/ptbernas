<section id="portfolio" class="portfolio section bg-light">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2 class="d-flex align-items-center justify-content-center">{{ $activity->title }}&nbsp;<a href="/service"
                class="btn btn-dark btn-circle d-flex align-items-center justify-content-center bold">
                <i class="bi bi-arrow-up-right" style="-webkit-text-stroke: 1px;"></i>
            </a></h2>
        <p class="fs-6">
            {{ $activity->subtitle }}
        </p>
    </div>
    <!-- End Section Title -->
    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200" id="parentku">
                @include('Components.card-activities')
            </div>
        </div>
        <div class="d-flex justify-content-center text-center text-lg-start my-5">
            <a href="/gallery"
                class="btn btn-dark btn-read-more d-inline-flex align-items-center justify-content-between px-3">
                <span>Read More</span>
                <i class="bi bi-arrow-up-right"></i>
            </a>
        </div>
    </div>
</section>

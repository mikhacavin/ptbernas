<section id="portfolio" class="portfolio section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $title }}</h2>
        <p>{{ $subtitle }}</p>
    </div>
    <!-- End Section Title -->
    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-5 isotope-container" data-aos="fade-up" data-aos-delay="200" id="parentku">
                @include('components.card-activities')
            </div>
            <div id="loading" class="fs-5 fw-bold mt-2" style="display:none; text-align:center;">Loading ⏳...</div>
            <div id="no-data" class="fs-5 fw-bold mt-5" style="display:none; text-align:center;">You've reach the end
                🚩.
            </div>

        </div>
    </div>
    @push('script')
        <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
        <script>
            $(document).ready(function() {
                // Inisialisasi Isotope saat halaman siap
                let $isotopeContainer = $('.isotope-container').isotope({
                    itemSelector: '.portfolio-item',
                    layoutMode: 'masonry'
                });

                // Inisialisasi Glightbox untuk data awal
                const lightbox = GLightbox({
                    selector: '.glightbox'
                });

                let nextPageUrl = '{{ $activities->nextPageUrl() }}';

                $(window).scroll(function() {
                    // Check the position of the last item
                    let lastItem = $('.isotope-container .portfolio-item').last();
                    if (lastItem.length) {
                        let lastItemOffset = lastItem.offset().top + lastItem.outerHeight();
                        let scrollPosition = $(window).scrollTop() + $(window).height();

                        // Trigger when user scrolls near the last item
                        if (scrollPosition >= lastItemOffset - 100) {
                            if (nextPageUrl) {
                                loadMoreActivity();
                            }
                        }
                    }
                });

                function loadMoreActivity() {
                    // Tampilkan efek loading
                    $('#loading').show();
                    $.ajax({
                        url: nextPageUrl,
                        type: 'get',
                        beforeSend: function() {
                            nextPageUrl = '';
                        },
                        success: function(data) {
                            let $newItems = $(data.view);

                            // Append the new items to the container
                            $('#parentku').append($newItems);

                            // Pastikan gambar sudah dimuat sebelum melakukan relayout
                            $newItems.imagesLoaded(function() {
                                $isotopeContainer.isotope('appended', $newItems).isotope('layout');
                            });

                            // Re-inisialisasi Glightbox setelah item baru dimuat
                            GLightbox({
                                selector: '.glightbox'
                            });

                            // Update nextPageUrl
                            nextPageUrl = data.nextPageUrl;


                            // Sembunyikan efek loading setelah selesai
                            $('#loading').hide();

                            // Jika tidak ada lagi data, tampilkan pesan
                            if (!nextPageUrl) {
                                $('#no-data').show();
                            } else {
                                $('#no-data').hide();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error loading more Activity:", error);
                            // Sembunyikan efek loading setelah selesai
                            $('#loading').hide();
                        }
                    });
                }
            });
        </script>
    @endpush
</section>

@foreach ($activities as $activity)
    <div class="col-lg-4 col-md-6 portfolio-item isotope-item p-1">
        @if (strpos($activity->file_url, 'youtube.com') !== false || strpos($activity->file_url, 'youtu.be') !== false)
            <div class="iframe-container">
                {!! $activity->file_url !!}
            </div>
        @else
            <img src="{{ asset('storage/' . $activity->file_url) }}" class="img-fluid" alt="" />
            <div class="portfolio-info">
                <h4>{{ $activity->title }}</h4>
                <p>{{ $activity->desc }}</p>
                <a href="{{ asset('storage/' . $activity->file_url) }}" title="{{ $activity->title }}"
                    data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
            </div>
        @endif
    </div>
@endforeach

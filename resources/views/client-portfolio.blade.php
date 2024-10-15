@extends('Layout.client')
@section('content')
    @component('components.header', [
        'image_url' => $portfolioClientsPage->image_url,
        'title' => $portfolioClientsPage->title_page,
    ])
    @endcomponent
    <section class="p-0">
        <div class="row bg-dark py-4">
            <h2 class="title text-center text-white mb-2 mt-3">{{ $portfolioClientsPage->title_client }}</h2>
            <div class="col-lg-12 d-flex flex-wrap justify-content-center">
                @foreach ($clients as $client)
                    <div class="p-lg-5 p-3 custom-image-slide">
                        <img src="{{ asset('storage/' . $client->image_url) }}" alt="" class="img-fluid"
                            style="max-height: 70px; object-fit: contain;">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Blog Details Section -->
                <section id="blog-details" class="blog-details section p-0">
                    <div class="container">
                        <article class="article p-lg-3">
                            <div class="content py-2 pt-0">
                                <h1 class="title text-center">{{ $portfolioClientsPage->title_portfolio }}</h1>
                                <p class="m-0 text-center pb-4">{{ $portfolioClientsPage->subtitle_portfolio }}</p>
                                <hr class="m-3" />
                                @foreach ($portfolio as $work)
                                    <div class="row align-items-center muncul py-3 get-data" data-id="{{ $work->id }}"
                                        style="cursor: pointer;">
                                        <div class="col text-center">
                                            <p class="fw-bold">{{ $work->clients->name }}</p>
                                        </div>
                                        <div class="col text-center">
                                            <p class="fs-5">{{ $work->title }}</p>
                                        </div>
                                        <div class="col text-center">
                                            <p class="fw-bold">{{ \Carbon\Carbon::parse($work->date)->format('Y') }}</p>
                                        </div>
                                    </div>
                                    <hr class="m-3" />
                                @endforeach
                            </div>
                        </article>
                        <div class="container">
                            <div class="row row-cols-1 row-cols-md-3 g-3">

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const portfolioModal = new bootstrap.Modal(document.getElementById('portfolioModal'));
                document.querySelectorAll('.get-data').forEach(item => {
                    item.addEventListener('click', function() {
                        this.style.cursor = 'wait'; // Set cursor to loading
                        const portfolioId = this.getAttribute('data-id');
                        fetchPortfolioDetails(portfolioId);
                    });
                });

                function fetchPortfolioDetails(id) {
                    fetch(`/portfolio/${id}`)
                        .then(response => response.json())
                        .then(data => {
                            updateModalContent(data);
                            portfolioModal.show();
                            document.querySelectorAll('.get-data').forEach(item => {
                                item.style.cursor = 'pointer'; // Set cursor back to default
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching portfolio details:', error);
                            document.querySelectorAll('.get-data').forEach(item => {
                                item.style.cursor = 'pointer'; // Set cursor back to default
                            });
                        });
                }

                function updateModalContent(data) {
                    // Update image
                    console.log(data);
                    document.querySelector('#portfolioModal .modal-body img').src =
                        `/storage/${data.portfolio.clients.image_url}`;

                    // Update client name and title
                    document.querySelector('#portfolioModal .modal-body #cname_porto').innerText =
                        `${data.portfolio.clients.name} - ${data.portfolio.title}`;

                    // Update services, location, and date
                    document.querySelector('#portfolioModal .modal-body #cname_porto2').innerText =
                        `${data.portfolio.service_items.name} - ${data.portfolio.location} | ${new Date(data.portfolio.date).getFullYear()}`;

                    // Update description
                    const descriptionElement = document.querySelector(
                        '#portfolioModal .modal-body .col-lg-12 #desc');
                    descriptionElement.innerHTML = data.portfolio.desc; // Use innerHTML to render the HTML content

                    const client_title = document.querySelector('#client-title');
                    client_title.innerText = data.portfolio.clients.name;

                    const galleryContainer = document.querySelector('#portfolioModal .modal-body .gallery-portfolio');
                    galleryContainer.innerHTML = ''; // Clear previous content

                    if (data.portfolio.activities_gallery && data.portfolio.activities_gallery.length > 0) {
                        // Append images or iframes from activities_gallery
                        data.portfolio.activities_gallery.forEach(item => {
                            const itemContainer = document.createElement(
                                'div'); // Create a container for each item
                            itemContainer.style.margin = '5px'; // Add some margin around each item
                            itemContainer.style.flex =
                                '0 1 auto'; // Prevent items from growing larger than their content

                            if (item.file_url.includes('<iframe')) {
                                // If it's an iframe, directly insert the HTML
                                itemContainer.innerHTML = item
                                    .file_url; // Assuming this contains the full iframe HTML
                                const iframe = itemContainer.querySelector('iframe'); // Select the iframe

                                // Set iframe styles
                                iframe.style.width = '200px'; // Set width for the iframe
                                iframe.style.height = '140px'; // Set height to auto
                                iframe.style.borderRadius = '10px'; // Set border radius for the iframe
                                iframe.style.overflow = 'hidden'; // Prevent overflow (optional)
                            } else {
                                // Otherwise, create an image element
                                const imgElement = document.createElement('img');
                                imgElement.src = `/storage/${item.file_url}`;
                                imgElement.alt = 'Gallery Image';
                                imgElement.classList.add('img-fluid', 'rounded');
                                imgElement.style.maxWidth = '200px'; // Set a size for images
                                imgElement.style.maxHeight = '140px'; // Set a height limit for images
                                itemContainer.appendChild(imgElement); // Append the image to the item container
                            }

                            galleryContainer.appendChild(
                                itemContainer); // Append the item container to the gallery
                        });
                    } else {
                        document.querySelector('.another-activity-items').style.display = 'none';
                    }


                    if (data.other_portfolios && data.other_portfolios.length > 0) {
                        const otherPortfoliosContainer = document.querySelector('#portfolioModal .modal-body .card');
                        otherPortfoliosContainer.innerHTML = ''; // Clear previous other portfolios
                        data.other_portfolios.forEach(portfolio => {
                            const portfolioItem = document.createElement('p');
                            portfolioItem.innerText =
                                `${portfolio.title}`; // Display the title of the other portfolio
                            otherPortfoliosContainer.appendChild(portfolioItem); // Append to card
                        });
                    } else {
                        document.querySelector('.another-portfolio-items').style.display = 'none';
                    }
                }
            });
        </script>
    @endpush
    @component('components.contact', ['contacts' => $contacts, 'contactdetail' => $contactdetail])
    @endcomponent
    @component('Components.modal-detail-portfolio')
    @endcomponent
@endsection

@section('meta')
    <title>{{ $header->site_name }}</title>
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon" />
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />
@endsection

@section('header')
    @include('components.navbar', [
        'data' => $header,
    ])
@endsection

@section('footer')
    @include('components.footer', [
        'data' => $footer,
        'header' => $header,
    ])
@endsection

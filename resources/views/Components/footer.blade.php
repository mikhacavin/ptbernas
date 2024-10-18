<footer id="footer" class="footer bg-dark text-white">
    <div class="container footer-top">
        <div class="row gy-4 py-5">
            <div class="col-lg-4 col-md-6 footer-about">
                <a href="/" class="d-flex align-items-center">
                    <img src="{{ asset('storage/' . $header->image_url) }}" alt="" width="55rem"
                        class="image-footer">
                    <h4 class="sitename fs-5 p-0 m-0 text-white">{{ $header->site_name }}</h4>
                </a>
                <div class="footer-contact pt-3">
                    <p>{{ $footer->desc }}</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>{{ $footer->quick_links_title }}</h4>
                <ul>
                    @foreach ($footer_links->where('type', 0) as $link)
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="{{ $link->link }}">{{ $link->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-3 footer-links">
                <h4>{{ $footer->other_pages_title }}</h4>
                <ul>
                    @foreach ($footer_links->where('type', 1) as $link)
                        <li>
                            <i class="bi bi-chevron-right"></i> <a href="{{ $link->link }}">{{ $link->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-4 col-md-12">
                <h4>{{ $footer->socmed_title }}</h4>
                <p>
                    {{ $footer->socmed_desc }}
                </p>
                <div class="social-links d-flex">
                    @foreach ($sosmeds as $sosmed)
                        <a href="{{ $sosmed->url }}">{!! $sosmed->icon !!}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container copyright text-center">
        <div class="row d-flex jutify-content-center">
            <div class="col-lg-7 mb-4 mx-auto">
                <img src="{{ asset('storage/' . $footer->image_url) }}" alt="" width="100%" class="d-block">
            </div>
        </div>
        <p>
            © <span>Copyright 2024</span>
            <strong class="px-1 sitename">{{ $header->site_name }}</strong>
            <span>All Rights Reserved.</span>
        </p>
        <div class="credits text-white">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you've purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
            Developed by <a href="https://eloistic.com/" target="_blank">eloistic.com</a>
        </div>
    </div>

</footer>

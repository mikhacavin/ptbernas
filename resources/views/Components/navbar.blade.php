<header id="header"
    class="header d-flex align-items-center @if (request()->is('/')) fixed-top @else sticky-top @endif">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="/" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src=" {{ asset('storage/' . $header->image_url) }}" alt="" height="100px" />
            <h1 class="sitename">
                {{ $header->site_name }}
            </h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                {{-- <li>
                    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home<br /></a>
                </li>
                <li><a href="/about" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
                <li class="dropdown">
                    <a href="#"
                        class="{{ request()->is(['service', 'portfolio', 'gallery']) ? 'active' : '' }}"><span>Our
                            Works</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="/service" class="{{ request()->is('service') ? 'active' : '' }}">Services</a></li>
                        <li><a href="/portfolio" class="{{ request()->is('portfolio') ? 'active' : '' }}">Clients &
                                Portfolio</a></li>
                        <li><a href="/gallery" class="{{ request()->is('gallery') ? 'active' : '' }}">Gallery</a></li>
                    </ul>
                </li>
                <li><a href="/blog" class="{{ request()->is('blog') ? 'active' : '' }}">Blog</a></li>
                <li><a href="/certification"
                        class="{{ request()->is('certification') ? 'active' : '' }}">Certifications</a></li> --}}
                @foreach ($menus as $menu)
                    <li class="{{ $menu->children->isNotEmpty() ? 'dropdown' : '' }}">
                        <a href="{{ $menu->url }}"
                            class="{{ ($menu->url === '/' && (request()->is('/') || request()->path() === '')) || request()->is(ltrim($menu->url, '/')) ? 'active' : '' }}">
                            <span>{{ $menu->name }}</span>
                            @if ($menu->children->isNotEmpty())
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            @endif
                        </a>
                        @if ($menu->children->isNotEmpty())
                            <ul>
                                @foreach ($menu->children as $child)
                                    <li>
                                        <a href="{{ $child->url }}"
                                            class="{{ request()->is(ltrim($child->url, '/')) ? 'active' : '' }}">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted flex-md-shrink-0" href="/contact">Contact</a>
    </div>

    <!-- whatsapp floating -->

    <div id="whatsapp-chat" class="hide whatsapp-widget" style="font-family: 'Lato', sans-serif">
        <div class="header-chat">
            <div class="head-home">
                <h3 style="color: white">Hello!👋</h3>
                <p>
                    You can ask us via email at :
                    <a href="mailto:cs@ptbernas.co.id"
                        style="color: white; text-decoration: underline">cs@ptbernas.co.id</a>
                </p>
                <!-- Perbaikan penutupan tag <a> -->
            </div>
            <div class="get-new hide">
                <a class="back-chat" href="javascript:void(0)"
                    style="color: white; text-decoration: underline">&lt;Back</a>
                <!-- Perbaikan href='javascript:void' menjadi href='javascript:void(0)' -->
                <div id="get-label"></div>
                <div id="get-nama"></div>
            </div>
        </div>
        <div class="home-chat">
            <!-- Info Contact Start -->
            @foreach ($cs as $item)
                <a class="informasi" href="javascript:void(0)" title="Chat Whatsapp">
                    <!-- Perbaikan href='javascript:void' menjadi href='javascript:void(0)' -->
                    <div class="info-avatar">
                        <img src="{{ asset('storage/' . $item->image_url) }}" />
                    </div>
                    <div class="info-chat">
                        <span class="chat-label">Sales</span>
                        <span class="chat-nama">{{ $item->name }}</span>
                    </div>
                    <span class="my-number">{{ $item->phone }}</span>
                </a>
            @endforeach
            <!-- Info Contact End -->
            <div class="blanter-msg">
                We will respond immediately.
            </div>
        </div>
        <div class="start-chat hide">
            <div class="first-msg">
                <span>Hello! we're happy to help you 🤗</span>
            </div>
            <div class="blanter-msg">
                <textarea id="chat-input" placeholder="Your Message here.." maxlength="120" rows="1"></textarea>
                <!-- Perbaikan atribut row menjadi rows -->
                <a href="javascript:void(0);" id="send-it">Send</a>
                <!-- Perbaikan href='javascript:void' menjadi href='javascript:void(0)' -->
            </div>
        </div>
        <div id="get-number"></div>
        <a class="close-chat" href="javascript:void(0)">&times;</a>
        <!-- Perbaikan href='javascript:void' menjadi href='javascript:void(0)' -->
    </div>
    <a class="blantershow-chat" href="javascript:void(0)" title="Show Chat"><i class="fab fa-whatsapp"></i>How can I
        help you?</a>

    <!-- endd floating whatsapp -->
</header>
@push('script')
    <script>
        /* Whatsapp Chat Widget by www.idblanter.com */

        $(document).on("click", "#send-it", function() {
            var a = document.getElementById("chat-input");
            if ("" != a.value) {
                var b = $("#get-number").text(),
                    c = document.getElementById("chat-input").value,
                    d = "https://web.whatsapp.com/send",
                    e = b,
                    f = "&text=" + c;
                if (
                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                        navigator.userAgent
                    )
                )
                    var d = "whatsapp://send";
                var g = d + "?phone=" + e + f;
                window.open(g, "_blank");
            }
        });

        $(document).on("click", ".informasi", function() {
            document.getElementById("get-number").innerHTML = $(this)
                .children(".my-number")
                .text();
            $(".start-chat, .get-new").addClass("show").removeClass("hide");
            $(".home-chat, .head-home").addClass("hide").removeClass("show");
            document.getElementById("get-nama").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-nama")
                .text();
            document.getElementById("get-label").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-label")
                .text();
        });

        // Back
        $(document).on("click", ".back-chat", function() {
            $(".start-chat, .get-new").addClass("hide").removeClass("show");
            $(".home-chat, .head-home").addClass("show").removeClass("hide");
            document.getElementById("get-nama").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-nama")
                .text();
            document.getElementById("get-label").innerHTML = $(this)
                .children(".info-chat")
                .children(".chat-label")
                .text();
        });

        $(document).on("click", ".close-chat", function() {
            $("#whatsapp-chat").addClass("hide").removeClass("show");
        });

        $(document).on("click", ".blantershow-chat", function() {
            $("#whatsapp-chat").addClass("show").removeClass("hide");
        });
    </script>
@endpush

@push('css')
    <style>
        @import url("https://use.fontawesome.com/releases/v5.8.2/css/all.css");

        .whatsapp-widget a:link,
        .whatsapp-widget a:visited {
            color: white;
            text-decoration: none;
            transition: all 0.4s ease-in-out;
        }

        .whatsapp-widget h1 {
            font-size: 20px;
            text-align: center;
            display: block;
            background: linear-gradient(to right top, #007c7c, #005555);
            padding: 20px;
            color: #fff;
            border-radius: 50px;
        }

        .whatsapp-widget .credit {
            background: #fff;
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #ddd;
            border-radius: 20px;
        }

        /* CSS Multiple Whatsapp Chat */

        #whatsapp-chat {
            position: fixed;
            background: #fff;
            width: 350px;
            border-radius: 10px;
            box-shadow: 0 1px 15px rgba(32, 33, 36, 0.28);
            bottom: 90px;
            right: 30px;
            overflow: hidden;
            z-index: 99;
            animation-name: showchat;
            animation-duration: 1s;
            transform: scale(1);
        }

        a.blantershow-chat {
            background: linear-gradient(to right top, #007c7c, #005555);
            color: #fff;
            position: fixed;
            z-index: 98;
            bottom: 25px;
            right: 30px;
            font-size: 15px;
            padding: 10px 20px;
            border-radius: 30px;
            box-shadow: 0 1px 15px rgba(32, 33, 36, 0.28);
        }

        a.blantershow-chat i {
            transform: scale(1.2);
            margin: 0 10px 0 0;
        }

        .header-chat {
            background: linear-gradient(to right top, #007c7c, #005555);
            color: #fff;
            padding: 20px;
        }

        .header-chat h3 {
            margin: 0 0 10px;
        }

        .header-chat p {
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        .info-avatar {
            position: relative;
        }

        .info-avatar img {
            border-radius: 100%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            float: left;
            margin: 0 10px 0 0;
        }

        /* .info-avatar:before {
                              content: "\\f232";
                              z-index: 1;
                              font-family: "Font Awesome 5 Brands";
                              background: #23ab23;
                              color: #fff;
                              padding: 4px 5px;
                              border-radius: 100%;
                              position: absolute;
                              top: 30px;
                              left: 30px;
                            } */

        a.informasi {
            padding: 20px;
            display: block;
            overflow: hidden;
            animation-name: showhide;
            animation-duration: 2.5s;
        }

        a.informasi:hover {
            background: #f1f1f1;
        }

        .info-chat span {
            display: block;
        }

        #get-label,
        span.chat-label {
            font-size: 12px;
            color: #888;
        }

        #get-nama,
        span.chat-nama {
            margin: 5px 0 0;
            font-size: 15px;
            font-weight: 700;
            color: #222;
        }

        #get-label,
        #get-nama {
            color: #fff;
        }

        span.my-number {
            display: none;
        }

        .blanter-msg {
            color: #444;
            padding: 20px;
            font-size: 12.5px;
            text-align: center;
            border-top: 1px solid #ddd;
        }

        textarea#chat-input {
            border: none;
            font-family: "Arial", sans-serif;
            width: 100%;
            height: 20px;
            outline: none;
            resize: none;
        }

        a#send-it {
            color: #555;
            width: 40px;
            margin: -5px 0 0 5px;
            font-weight: 700;
            padding: 8px;
            background: #eee;
            border-radius: 10px;
        }

        .first-msg {
            background: #f5f5f5;
            padding: 30px;
            text-align: center;
        }

        .first-msg span {
            background: #e2e2e2;
            color: #333;
            font-size: 14.2px;
            line-height: 1.7;
            border-radius: 10px;
            padding: 15px 20px;
            display: inline-block;
        }

        .start-chat .blanter-msg {
            display: flex;
        }

        #get-number {
            display: none;
        }

        a.close-chat {
            position: absolute;
            top: 5px;
            right: 15px;
            color: #fff;
            font-size: 30px;
        }

        @keyframes showhide {
            from {
                transform: scale(0.5);
                opacity: 0;
            }
        }

        @keyframes showchat {
            from {
                transform: scale(0);
                opacity: 0;
            }
        }

        @media screen and (max-width: 480px) {
            #whatsapp-chat {
                width: auto;
                left: 5%;
                right: 5%;
                font-size: 80%;
            }
        }

        .hide {
            display: none;
            animation-name: showhide;
            animation-duration: 1.5s;
            transform: scale(1);
            opacity: 1;
        }

        .show {
            display: block;
            animation-name: showhide;
            animation-duration: 1.5s;
            transform: scale(1);
            opacity: 1;
        }

        .back-chat {
            font-size: 12px;
        }
    </style>
@endpush

<header class="header-area">
    <!-- Search Form -->
    <div class="search-form d-flex align-items-center">
        <div class="container">
            <form action="index.html" method="get">
                <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword ...">
                <button type="submit"><i class="icon_search"></i></button>
            </form>
        </div>
    </div>

    <!-- Top Header Area Start -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">

                <div class="col-6">
                    <div class="top-header-content">
                        <a href="#"><i class="icon_phone"></i> <span>(021) 655 3235 322</span></a>
                        <a href="#"><i class="icon_mail"></i> <span>admin@sibeaearesort.my.id</span></a>
                    </div>
                </div>

                <div class="col-6">
                    <div class="top-header-content">
                        <!-- Top Social Area -->
                        <div class="top-social-area ml-auto">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Top Header Area End -->

    <!-- Main Header Start -->
    <div class="main-header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="robertoNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="{{ url('/') }}"><img src="{{ asset('assets/images/logo-sibea-bea.png') }}" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- Menu Close Button -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>
                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul id="nav">
                                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ route('kamar.list') }}">Kamar</a></li>
                                <li><a href="{{ route('wisata.terdekat') }}">Wisata Terdekat</a></li>
                                @auth
                                <li><a href="#"
                                    >Halo {{ ucfirst(Auth::user()->name) }}</a>
                                    <ul class="dropdown">
                                        <li><a href="{{ route('profile.index') }}">- Profil</a></li>
                                        <li><a href="{{ route('transaksi.index') }}">- Transaksi</a></li>
                                        <li><a href=""
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                            >- Logout</a></li>
                                    </ul>
                                </li>

                                @endauth
                                @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                                @endguest
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                            <!-- Search -->
                            {{-- <div class="search-btn ml-4">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </div> --}}

                            <!-- Book Now -->
                            {{-- <div class="book-now-btn ml-3 ml-lg-5">
                                <a href="#">Book Now <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div> --}}
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Additional CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/menu.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

<!-- Add in the <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        /* Custom Styles */
        .book-image {
            border-radius: 20px;
            width: 100%; /* Adjust the size for larger display */
            height: 100vh;
        }

        .author-image {
            max-width: 80px; /* Increase author image size */
            border-radius: 50%;
        }

        .add-to-cart-btn {
            margin-top: 10px;
        }

        /* Logo Styling */
        .logo img {
            max-width: 180px; /* Adjust the logo size */
            height: auto;
            background-color: white;
        }

        /* Additional spacing for form and search elements */
        form.row {
            margin: 20px 0;
        }

        /* Additional styles for responsive design */
        @media (max-width: 768px) {
            .book-image {
                width: 100%; /* Full width for smaller screens */
            }
            .author-image {
                max-width: 60px; /* Adjust author image on smaller screens */
            }
        }
    </style>
</head>

<body>

<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{url('/')}}" class="logo">
                    <img src="assets/images/logo.png" alt="">
                        
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <form action="{{url('search')}}" method="Post" class="row" style="margin: 20px;">
                        @csrf
                        <div class="col-md-8">
                            <input class="form-control" type="search" name="search" placeholder="Search for book title or author name">
                        </div>
                        <div class="col-md-4">
                            <input class="btn btn-primary"  type="submit" value="search">
                        </div>
                    </form>

                    <ul class="nav">
                        <li><a href="{{url('/')}}" class="active">Home</a></li>
                        <li><a href="{{url('/explore')}}" class="active">Explore</a></li>

                        @auth
                            <li><a href="{{ url('show_cart') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
                            <li><a href="{{ url('book_history')}}">History</a></li>
                            <li><a href="{{ url('/profile') }}">Welcome, {{ Auth::user()->name }}</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <input class="btn btn-success" type="submit" value="Logout">
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            @if(Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<!-- Book Details Section -->
<div class="item-details-page">
    <div class="container">
        <div class="row">
            <!-- Book Image Section -->
            <div class="col-lg-7">
                <div class="left-image">
                    <!-- Book Image -->
                    <img src="/book/{{ $books->book_img }}" alt="{{ $books->title }}" class="book-image">
                </div>
            </div>

            <!-- Book Details Section -->
            <div class="col-lg-5 align-self-center">
                <h4>{{ $books->title }}</h4>
                <span class="author">
                    <!-- Author Image -->
                    <img src="/author/{{ $books->author_img }}" alt="{{ $books->author_name }}" class="author-image">
                    <h6>{{ $books->author_name }}</h6>
                </span>
                <!-- Book Description -->
                <p>{{ $books->description }}</p>

                <!-- Availability and Add to Cart -->
                <div class="row">
                    <div class="col-3">
                        <span class="bid">
                            Available<br><strong>{{ $books->quantity }}</strong><br>
                        </span>
                    </div>
                </div>

                <!-- Add to Cart Button -->
                <div class="">
                    <a href="{{ url('add_cart', $books->id) }}" class="btn btn-primary add-to-cart-btn">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
@include('user.footer')

<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>


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
                        <input class="btn btn-primary"  style="padding-right:8px;" type="submit" value="search">
                    </div>
                </form>



                    <ul class="nav">
                        <li><a href="{{url('/')}}" class="active">Home</a></li>
                        <li><a href="{{url('/explore')}}" class="active">explore</a></li>
                    
                    
                        

                        @auth
                      
                                <li><a href="{{ url('show_cart') }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a></li>
                                <li><a href="{{ url('book_history')}}">History</a></li>

                                <li><a href="{{ url('/profile') }}">Welcome, {{ Auth::user()->name }}</a></li>
                                <li>
                                    <form method="POST"  action="{{ route('logout') }}">
                                        @csrf
                                        <input style="display: grid;" class="btn btn-success" type="submit" value="Logout">
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

    
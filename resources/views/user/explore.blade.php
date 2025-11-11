
<!DOCTYPE html>
<html>
<head>
    @include('user.css') <!-- Include user-specific CSS -->
</head>
<body>
    @include('user.header') <!-- Include the header -->

    <div class="currently-market">
        <div class="container">
            <div class="row">
                <!-- Filters Section -->
                <div class="col-lg-6">
                    <div class="filters">
                        <ul>
                            <!--<li data-filter="*" class="active"></li>-->
                        </ul>
                    </div>
                </div>

                <!-- Display Books Section -->
                <div class="col-lg-12">
                    <div class="row grid">
                        @forelse($book as $bookItem)
                        <div class="col-lg-6 col-md-6 col-sm-12 currently-market-item all msc" style="margin-bottom: 30px;">
                            <div class="item" style="display: flex; align-items: center;">
                                <div class="left-image" style="margin-right: 15px;">
                                    <img src="{{ asset('book/' . $bookItem['book_img']) }}" alt="" style="border-radius: 20px; min-width: 195px;">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $bookItem['title'] }}</h4>
                                    <span class="author" style="display: flex; align-items: center; margin-top: 5px;">
                                        <img src="{{ asset('author/' . $bookItem['author_img']) }}" alt="" style="max-width: 50px; border-radius: 50%; margin-right: 10px;">
                                        <h6 style="margin: 0;">{{ $bookItem['author_name'] }}</h6>
                                    </span>
                                    <div class="line-dec"></div>
                                    <span class="bid" style="display: block; margin-top: 10px;">
                                        Current Available<br><strong>{{ $bookItem['quantity'] }}</strong><br>
                                    </span>
                                    <div class="text-button" style="margin-top: 10px;">
                                    <a href="{{ url('book_details', $bookItem['id']) }}">View Item Details</a>
                                    </div>
                                    <div class="">
                                        <a style="margin-top: 10px;" class="btn btn-primary" href="{{ url('add_cart', $bookItem['id']) }}">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>Not enough available for this criteria</p> <!-- Message if no books are found -->
                        @endforelse
                    </div>
                  
                </div>
            </div>
        </div>
    </div>

    @include('user.footer') <!-- Include the footer -->
</body>
</html>

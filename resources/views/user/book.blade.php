
<div class="currently-market">
    <div class="container">
        <div class="row">
           

            <!-- Filters -->
            <div class="col-lg-6">
                <div class="filters">
                    <ul>
                       <!-- <li data-filter="*" class="active">All Books</li>-->
                       
                    </ul>`
                </div>
            </div>

          

            <!-- Display Books -->
            <div class="col-lg-12">
                <div class="row grid">
                    @foreach($book as $books)
                    <div class="col-lg-6 col-md-6 col-sm-12 currently-market-item all msc" style="margin-bottom: 30px;">
                        <div class="item" style="display: flex; align-items: center;">
                            <div class="left-image" style="margin-right: 15px;">
                                <img src="book/{{ $books->book_img }}" alt="" style="border-radius: 20px; min-width: 195px;">
                            </div>
                            <div class="right-content">
                                <h4>{{ $books->title }}</h4>
                                <span class="author" style="display: flex; align-items: center; margin-top: 5px;">
                                    <img src="author/{{ $books->author_img }}" alt="" style="max-width: 50px; border-radius: 50%; margin-right: 10px;">
                                    <h6 style="margin: 0;">{{ $books->author_name }}</h6>
                                </span>
                                <div class="line-dec"></div>
                                <span class="bid" style="display: block; margin-top: 10px;">
                                    Current Available<br><strong>{{ $books->quantity }}</strong><br>
                                </span>
                                <div class="text-button" style="margin-top: 10px;">
                                <a href="{{ url('book_details', $books->id) }}">View Item Details</a>
                                </div>
                                <div class="">
                                    <a style="margin-top: 10px;" class="btn btn-primary" href="{{ url('add_cart', $books->id) }}">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center" style="margin-top: 20px;">
                    {{ $book->links() }}
                </div>
              
            </div>
        </div>
    </div>
</div>







<!DOCTYPE html>
<html>
  <head> 
   
  @include('admin.css')
   <style type="text/css">
    .div_center{
        margin: auto;
        align-items: center;
        text-align: center;
    }
    .h1{
        color: #fff;
        padding: 30px;
        font-size: 30px;
        font-weight: bold;
    }
    label{
        display: inline-block;
        width: 200px;
    }
    .div_pad{
        padding: 15px;
    }

    .img_author{
        width: 80px;
        border-radius: 50%;
        margin: auto;
    }
    .img_book{
        width: 80px;
        margin: auto;
    }



   </style>
  </head>
  <body>
  
  @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
    
          
<div class="page-content">
        <div class="page-header">
          <div class="container-fluid">


         
          
            <div class="div_center">
                <h1 class="h1">Update Book</h1>
                <form action="{{url('update_book',$book->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_pad">
                        <label>Book Title</label>
                        <input type="text" name="title" value="{{$book->title}}">
                    </div>

                    <div  class="div_pad">
                        <label>Author name</label>
                        <input type="text" name="auhor_name" value="{{$book->author_name}}">
                    </div>
                    <div  class="div_pad">
                        <label>Price</label>
                        <input type="text" name="price" value="{{$book->price}}">
                    </div>
                    <div  class="div_pad">
                        <label>Quantity</label>
                        <input type="text" name="quantity" value="{{$book->quantity}}">
                    </div>
                    <div  class="div_pad">
                        <label>Description</label>
                        <textarea name="description">{{$book->description}}</textarea>
                        
                    </div>
                    <div  class="div_pad">
                        <label>Category</label>
                        <select name="category">
                            <option value="{{$book->category_id}}">{{$book->category->category_title}}</option>
                            @foreach($category as $category)
                            <option value="{{$category->id}}">{{$category->category_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div  class="div_pad">
                        <label>Current Author Image</label>
                        <img  class="img_author"src="/author/{{$book->author_img}}">
                    </div>
                    <div  class="div_pad">
                        <label>Change Author image</label>
                        <input type="file" name="Author_img">
                    </div>
                    <div  class="div_pad">
                        <label>Current Book Image</label>
                        <img  class="img_book"src="/book/{{$book->book_img}}">
                    </div>
                    <div  class="div_pad">
                        <label>Change Book image</label>
                        <input type="file" name="Book_img">
                    </div>
                    <div  class="div_pad">
                        <input class="btn btn-info" type="submit" value="Update Book">
                    </div>
                </form>
            </div>


          </div>
        </div>
</div>
       @include('admin.footer')
  </body>
</html>
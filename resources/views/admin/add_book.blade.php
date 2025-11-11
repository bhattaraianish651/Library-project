



<!DOCTYPE html>
<html>
  <head> 
   
  @include('admin.css')
  <style type="text/css">
    .container{
      text-align: center;
      margin: auto;

    }
    .h1{
      color: #fff;
      padding: 35px;
      font-size: 40px;
      font-weight: bold;
    }

    label{
      display: inline-block;
      width: 200px;
    }
    .div_center{
      padding: 15px;
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
        
          

          

          <div class="container">
            <h1 class="h1">Add Books</h1>
            <form action="{{url('store_book')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="div_center">
                <label>Book Title</label>
                <input type="text" name="book_name">
              </div>
              <div  class="div_center">
                <label>Author name</label>
                <input type="text" name="author_name">
              </div>
              <div  class="div_center">
                <label>Price</label>
                <input type="text" name="price">
              </div>
              <div  class="div_center">
                <label>Quantity</label>
                <input type="number" name="quantity">
              </div>
              <div  class="div_center">
                <label>Description</label>
                <textarea name="description"></textarea>
              </div>
              <div  class="div_center">
                <label>Category</label>
                <select name="category" required>
                  <option>Select Category</option>
                  @foreach($category as $category)
                  <option value="{{$category->id}}">{{$category->category_title}}</option>
                  @endforeach
                </select>
              </div>
              
              <div  class="div_center">
                <label>Book Image</label>
                <input type="file" name="book_img">
              </div>
              <div  class="div_center">
                <label>Author Image</label>
                <input type="file" name="author_img">
              </div>
              
              <div  class="div_center">
                <input class="btn btn-info" type="submit" value="Add Book">
              </div>
            </form>
          </div>



          </div>
        </div>
</div>
       @include('admin.footer')
  </body>
</html>

<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      
      .div_deg{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;

      }
      .table_center{
        border: 2px solid greenyellow;
      }
      th {
          background-color: skyblue;
          padding: 15px;
          font-size: 19px;
          font-weight: bold;
          color: #fff;
      }
      .img_author {
          width: 80px;
          border-radius: 50%;
      }
      .img_book {
          width: 150px;
          height: auto;
          margin-bottom: 14px;
      }
      .pagination_center {
          text-align: center;
          margin-top: 20px;
      }
      .pagination_center ul {
          display: inline-flex;
          list-style: none;
      }
      .pagination_center li {
          margin: 0 5px;
      }
      td{
        border: 1px solid skyblue;
        text-align: center;
      }
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation -->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end -->

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

           
          

            <div class="div_deg">
              <table class="table_center">
                <tr>
                  <th>Book Title</th>
                  <th>Author Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th>Category</th>
                  <th>Author Image</th>
                  <th>Book Image</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
                @foreach($book as $books)
                  <tr>
                    <td>{{$books->title}}</td>
                    <td>{{$books->author_name}}</td>
                    <td>{{$books->price}}</td>
                    <td>{{$books->quantity}}</td>
                    <td>{{$books->description}}</td>
                    <td>{{$books->category->category_title}}</td>
                    <td>
                      <img class="img_author" src="author/{{$books->book_img}}">
                    </td>
                    <td>
                      <img class="img_book" src="book/{{$books->book_img}}">
                    </td>
                    <td>
                    <a  href="{{url('edit_book',$books->id)}}" class="btn btn-info">Update</a> 
                    </td>
                    <td>
                      <a onclick="return confirm('Are you want to delete this')" href="{{url('book_delete',$books->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
              
              </table>
             
              
            </div>
            <div class="pagination_center">
                {{$book->links()}}
              </div>

          </div>
        </div>
      </div>
    </div>
    @include('admin.footer')
  </body>
</html>

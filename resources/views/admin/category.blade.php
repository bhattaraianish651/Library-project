


<!DOCTYPE html>
<html>
  <head> 
   
  @include('admin.css')
  <style type="text/css">


.div_center{
    text-align: center;
    margin: auto;
}
.h1{
    font-size: 30px;
    font-weight: bold;
    padding: 30px;
    color: white;
}
.center{
  margin: auto;
  width: 50%;
  text-align: center;
  margin-top: 50px;
  border: 1px solid white;
}
th{
  background-color: skyblue;
  padding: 10px;
  
}
tr{
  border: 1px solid white;
  padding: 10px;
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
    <h1 class="h1">Add Category</h1>
    







    <form action="{{url('add_category')}}" method="post">
        @csrf
        <span style="padding-right:15px ;">
        <label>Category Name</label>
        <input type="text" name="category" required>
        </span>
        <input class="btn btn-primary" type="submit" value="Add Category">
    </form>
<div>
    <table class="center">
      <tr>
        <th>Category Name</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
      @foreach($categories as $category)
      <tr>
        <td>{{$category['category_title']}}</td>
        <td>
        <a  class="btn btn-info" href="{{url('edit_category',$category['id'])}}">Update</a>  
        
      </td>
      <td>
      <a onclick="return confirm('Are you want to delete')" class="btn btn-danger" href="{{url('delete_category',$category['id'])}}">Delete</a>
     
      </td>
      </tr>
      @endforeach
    </table>
</div>
</div>


          </div>
        </div>
</div>


       @include('admin.footer')
  </body>
</html>
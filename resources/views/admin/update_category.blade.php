




<!DOCTYPE html>
<html>
  <head> 
   
  @include('admin.css')
  <style type="text/css">

    .div_center{
        text-align: center;
        margin: auto;

    }
    .h2{
        color: white;
        padding: 40px;
        font-size: 30px;
        font-weight: bold;
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
    <h2 class="h2">Update Category</h2>
    <form action="{{url('update_category',$category->id)}}" method="post">
        @csrf
        <label>Category Name</label>
        <input type="text" name="category_title" value="{{$category->category_title}}">
        <input type="submit" class="btn btn-info" value="update Category">
    </form>
</div>


</div>
</div>
</div>
       @include('admin.footer')
  </body>
</html>
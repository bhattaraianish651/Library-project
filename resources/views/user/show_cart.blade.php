<!DOCTYPE html>
<html lang="en">

<head>
  @include('user.css')
  <style type="text/css">
    .table_deg {
      border: 1px solid #ddd;
      margin: auto;
      text-align: center;
      margin-top: 100px;
      width: 80%;
      background-color: #333;
    }

    th {
      background-color: skyblue;
      color: #fff;
      font-weight: bold;
      font-size: 18px;
      padding: 10px;
    }

    td {
      color: #fff;
      background-color: black;
      border: 1px solid #ddd;
      padding: 10px;
    }

    .img_deg, .img_center {
      height: 100%;
      width: 100%;
      max-width: 200px;
      max-height: 200px;
    }

    .total_deg {
      font-size: 20px;
      padding: 20px;
      margin: 20px auto;
      text-align: center;
      color: #fff;
    }

    .borrow_section {
      text-align: center;
      margin-top: 20px;
    }

    .borrow_section h1 {
      color: #fff;
      margin-bottom: 20px;
    }

    .borrow_section .btn-success,
    .borrow_section .btn-primary {
      padding: 10px 20px;
      font-size: 18px;
    }

  
    

   
    
  </style>
   
 
</head>

<body>
  @include('user.header')

  <div class="currently-market">
    <div class="container">
      <div class="row">
        <table class="table_deg">
          <tr>
            <th>Book Title</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Book Image</th>
            <th>Author Image</th>
            <th>Action</th>
          </tr>

          <?php 
            $totalprice=0;
          ?>
          @foreach($cart as $carts)
          <tr>
            <td>{{$carts->book_title}}</td>
            <td>{{$carts->quantity}}</td>
            <td>{{$carts->price}}</td>
            <td><img class="img_deg" src="/book/{{$carts->book_img}}"></td>
            <td><img class="img_center" src="/author/{{$carts->author_img}}"></td>
            <td>
              <a onclick="return confirm('Are you sure you want to delete?')" href="{{url('remove_cart',$carts->id)}}" class="btn btn-danger">Remove</a>
            </td>
          </tr>

          <?php 
            $totalprice= $totalprice + $carts->price;
          ?>
          @endforeach
        </table>

        <div class="total_deg">
          <h1>Total Price: {{$totalprice}}</h1>
        </div>

        <div class="borrow_section">
          <h1>Proceed to Borrow</h1>
          <a href="{{url('confirm_order')}}" class="btn btn-primary">Cash on Delivery</a>
          <a href="{{url('stripe',$totalprice)}}" class="btn btn-success">Pay using card</a>
       
        
        
        </div>
      </div>
    </div>
  </div>

  @include('user.footer')

  
  
        
  
</body>


    <!-- Paste this code anywhere in you body tag -->
    

</html>

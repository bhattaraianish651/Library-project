<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style type="text/css">
      .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;
        width: 100%;
      }

      .table_center {
        border: 2px solid greenyellow;
        width: 100%;
        margin: auto;
        border-collapse: collapse;
        text-align: center;
      }

      th {
        background-color: skyblue;
        padding: 15px;
        font-size: 15px;
        font-weight: bold;
        color: #fff;
      }

      td {
        border: 1px solid skyblue;
        padding: 10px;
        text-align: center;
      }

      /* Styling the book image */
      .img_book {
        width: 150px;
        margin: auto;
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

      
      .btn-group {
        display: flex;
        gap: 5px;
        justify-content: center;
      }

      .btn {
        padding: 10px;
        font-size: 14px;
        cursor: pointer;
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

          <form method="GET" action="{{ route('borrow.filter') }}">
                <select name="filter" onchange="this.form.submit()">
                    <option value="">Select Filter</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
            </form>
            <form method="POST" action="{{ route('borrow.search') }}">
                @csrf
                <input type="text" name="search" placeholder="Search..." required>
                <button type="submit">Search</button>
            </form>
            <div class="div_deg">
              <table class="table_center">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Book Title</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Book Image</th>
                  <th>Payment Status</th>
                  <th>Status</th>
                  <th>Returned Status</th>
                  <th>Change Status</th>
                </tr>
                @foreach($borrow as $borrows)
                <tr>
                  <td>{{ $borrows->user->name }}</td>
                  <td>{{ $borrows->user->email }}</td>
                  <td>{{ $borrows->book->title }}</td>
                  <td>{{ $borrows->book->quantity }}</td>
                  <td>{{ $borrows->book->price }}</td>
                  <td>
                    <img class="img_book" src="/book/{{ $borrows->book->book_img }}">
                  </td>
                  <td>{{ $borrows->payment_status }}</td>
                  <td>
                    @if($borrows->status == 'approved')
                    <span style="color: skyblue;">{{ $borrows->status }}</span>
                    @elseif($borrows->status == 'rejected')
                    <span style="color: red;">{{ $borrows->status }}</span>
                    @elseif($borrows->status == 'returned')
                    <span style="color: yellow;">{{ $borrows->status }}</span>
                    @else
                    <span style="color: white;">{{ $borrows->status }}</span>
                    @endif
                  </td>
                  <td>
                    {{ $borrows->returned_status == 'Not Returned' ? 'Not Returned' : 'Returned' }}
                  </td>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-warning" href="{{ url('approve_book', $borrows->id) }}">Approved</a>
                      <a class="btn btn-danger" href="{{ url('rejected_book', $borrows->id) }}">Rejected</a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </table>
            
            </div>
            <div class="pagination_center">
                {{ $borrow->links() }}
              </div>
          </div>
        </div>
      </div>
      @include('admin.footer')
    </div>
  </body>
</html>

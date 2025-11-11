<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.css')
    <style type="text/css">
        .table_deg {
            border: 1px solid #ccc;
            margin: auto;
            text-align: center;
            margin-top: 100px;
            width: 90%;
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
            border: 1px solid #fff;
            padding: 10px;
        }

        .book_img {
            height: 100%;
            width: 100%;
            max-height: 120px;
            max-width: 80px;
            margin: auto;
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
                        <th>Book Name</th>
                        <th>Book Author</th>
                        <th>Book Quantity</th>
                        <th>Book Status</th>
                        <th>Image</th>
                        <th>Returned Status</th>
                        <th>Cancel</th>
                        <th>Returned</th>
                    </tr>
                    @foreach($borrow as $borrow)
                    <tr>
                        <td>{{$borrow->book->title}}</td>
                        <td>{{$borrow->book->author_name}}</td>
                        <td>{{$borrow->book->quantity}}</td>
                        <td>{{$borrow->status}}</td>
                        <td>
                            <img class="book_img" src="book/{{$borrow->book->book_img}}">
                        </td>
                        <td>{{$borrow->returned_status}}</td>
                        <td>
                            @if($borrow->status=='Applied')
                            <a onclick="return confirm('Are you sure you want to delete this?')" class="btn btn-danger" href="{{url('cancel_request',$borrow->id)}}">Cancel</a>
                            @else
                            <p style="color: white; font-weight: bold;">Not allowed</p>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{url('returned_book',$borrow->id)}}">Returned</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    @include('user.footer')
</body>
</html>

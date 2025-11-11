<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    //
 public function confirm_order(){

    
    $userid = Auth::user()->id;
    $user = Auth::user();
     
    
   
    $cart = Cart::where('user_id', '=', $userid)->get();
    foreach($cart as $carts)
    {
        $borrow=new Borrow;
        $borrow->name=$user->name;
        $borrow->email=$user->email;
        $borrow->phone=$user->phone;
        $borrow->address=$user->address;
        $borrow->user_id=$userid;
        $borrow->book_id=$carts->book_id;

        $borrow->price = $carts->price; 
        $borrow->quantity = $carts->quantity;

       
    
     
        $borrow->save();
       
    
    }
    $cart_remove=Cart::where('user_id',$userid)->get();
    foreach($cart_remove as $remove){
        $data=Cart::find($remove->id);
        $data->delete();
    }
    
    toastr()->timeOut(5000)->closeButton()->addSuccess('Borrow Added successfully');
    return redirect()->back();
        
   

}

public function filter(Request $request)
{
    $filter = $request->get('filter');
    $borrowQuery = Borrow::query();

    if ($filter === 'week') {
        $borrowQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    } elseif ($filter === 'month') {
        $borrowQuery->whereMonth('created_at', Carbon::now()->month);
    } elseif ($filter === 'year') {
        $borrowQuery->whereYear('created_at', Carbon::now()->year);
    }

    $borrow = $borrowQuery->paginate(3);
    return view('admin.borrow_request', compact('borrow'));
}
public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $borrow = Borrow::whereHas('user', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%$searchTerm%")
                    ->orWhere('email', 'LIKE', "%$searchTerm%");
            })
            ->orWhereHas('book', function ($query) use ($searchTerm) {
                $query->where('title', 'LIKE', "%$searchTerm%");
            })
            ->orWhere('status', 'LIKE', "%$searchTerm%")
            ->paginate(3);

        return view('admin.borrow_request', compact('borrow'));
    }

public function borrow_request(){
    $borrow=Borrow::paginate(3);
    return view('admin.borrow_request',compact('borrow'));
}
public function approve_book($id){

    $borrow=Borrow::find($id);
    $status=$borrow->status;
    if($status =='approved'){
        return redirect()->back();
    }
    else{
        $borrow->status='approved';
        $borrow->save();
        $bookid=$borrow->book_id;
        $book=Book::find($bookid);
        $book_qty=$book->quantity -'1';
        $book->quantity=$book_qty;
        $book->save();
        return redirect()->back();

    }
  
}


  

public function rejected_book($id){
    $borrow=Borrow::find($id);
    $borrow->status="rejected";
    $borrow->save();
    return redirect()->back();
}

    
    }

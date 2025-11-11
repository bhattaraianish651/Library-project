<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function add_cart($id){
        
         $user=Auth::user();
         $book=Book::find($id);

         $existingCartItem = Cart::where('user_id', $user->id)
         ->where('book_id', $book->id)
         ->first();

if ($existingCartItem) {
toastr()->timeOut(5000)->closeButton()->addError('This book is already in your cart');
return redirect()->back();
}

         
         if ($book && $book->quantity >= 1) {

            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->book_id = $book->id; // Set the book_id foreign key
            $cart->book_title = $book->title;
            $cart->quantity = 1; // Start with a quantity of 1
            $cart->price = $book->price;
            $cart->book_img = $book->book_img;
            $cart->author_img = $book->author_img;
          
            
            
            $cart->quantity = 1; // Start with a quantity of 1
            $cart->save();
            $book->quantity -= 1;
            
            $book->save();
            toastr()->timeOut(5000)->closeButton()->addSuccess('Cart Added Successfully');

            return redirect()->back();
        } else {
            
        toastr()->timeOut(5000)->closeButton()->addSuccess('Not Book Available');
            return redirect()->back();
        }
       
    }
             
              
                
           
              
    

         



         
   
         

public function show_cart(){
    $id=Auth::user()->id;
    $cart=Cart::where('user_id','=',$id)->get();

    return view('user.show_cart',compact('cart'));
}


public function remove_cart($id)
{
    $cart = Cart::find($id);

    if ($cart) {
        // Find the associated book by its ID
        $book = Book::find($cart->book_id); // Corrected from books_id to book_id

        if ($book) {
            // Increase the quantity of the book in the books table
            $book->quantity += $cart->quantity;
            $book->save();
        }

        // Delete the cart item
        $cart->delete();

        toastr()->timeOut(5000)->closeButton()->addSuccess('Cart Deleted Successfully');
    } else {
        toastr()->timeOut(5000)->closeButton()->addError('Cart Not Found');
    }
    return redirect()->back();
}

}

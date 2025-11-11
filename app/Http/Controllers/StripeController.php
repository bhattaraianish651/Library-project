<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Cart;
use Illuminate\Support\Facades\Session; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;


class StripeController extends Controller
{
    //
    public function stripe($totalprice){
        return view('user.stripe',compact('totalprice'));
    }
    public function stripePost(Request $request,$totalprice)
    {


        $validated = $request->validate([
            'stripeToken' => 'required|string',
            'name' => 'required|string|max:255', // Name should be a valid string
            'card_number' => 'required|numeric', // Ensure card number is a valid number
        ], [
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a valid string.',
            'card_number.required' => 'The card number is required.',
            'card_number.numeric' => 'The card number must be a valid numeric value.',
        ]);
    
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       
    
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "NPR",
                "source" => $request->stripeToken,
                "description" => "Test payment from complete." 
        ]);



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
            $borrow->payment_status="paid";
    
         
            $borrow->save();
           
        
        }
        $cart_remove=Cart::where('user_id',$userid)->get();
        foreach($cart_remove as $remove){
            $data=Cart::find($remove->id);
            $data->delete();
        }
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Payment Successfully');
    
            
      
       
        return redirect('/show_cart');
    }
}

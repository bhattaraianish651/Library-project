<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        
if(Auth::id()){
    $usertype=Auth()->user()->usertype;
    if($usertype=='user'){
        $book=Book::paginate(6);
       
        return view('user.index',compact('book'));
    }
    else if($usertype=='admin'){
        $user=User::where('usertype','user')->get()->count();
        $book=Book::all()->count();
        $borrow=Borrow::where('status','approved')->count();
        $returned=Borrow::where('returned_status','returned book')->count();
        $rejected=Borrow::where('status','rejected')->count();

        $totalPrice = 0;
        $totalsold = Borrow::where('status','Paid')->get();
        foreach($totalsold as $order)
        {
            $total = $borrow->price * $borrow->quantity;
            $totalPrice += $total;
            
        }
        return view('admin.index',compact('user','book','borrow','returned','rejected','totalPrice'));
    }
    else{
        return redirect()->back();
    }
}

    }
}

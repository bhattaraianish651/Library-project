<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){

        $book=Book::paginate('7');
    
        return view('user.index',compact('book'));
        
    }
    public function book_history(){

        $userid=Auth::user()->id;
        $borrow=Borrow::where('user_id','=',$userid)->get();
        return view('user.book_history',compact('borrow'));
    }
    public function cancel_request($id){
     
        $borrow = Borrow::find($id);

        if ($borrow) {
            $book = Book::find($borrow->book_id);

            if ($book) {
                $book->quantity += 1; 
                $book->save();
            }

            $borrow->delete();
            toastr()->timeOut(5000)->closeButton()->addSuccess('Book Borrow request canceled successfully');
        } else {
            toastr()->timeOut(5000)->closeButton()->addError('Borrow request not found');
        }

        return redirect()->back();
    }
    


  
   
  
    
    public function returned_book($id)
{
    $borrow = Borrow::find($id);

    if (!$borrow) {
        toastr()->timeOut(5000)->closeButton()->addError('Borrow record not found');
        return redirect()->back();
    }

    $returned_status = $borrow->returned_status;

    if ($returned_status === 'returned book') {
        toastr()->timeOut(5000)->closeButton()->addSuccess('Book already returned');
        return redirect()->back();
    }

   
    if ($returned_status === 'rejected' || $returned_status === 'applied') {
        $borrow->returned_status = 'returned book';
        $book = Book::find($borrow->book_id);

        if ($book) {
            $book->quantity += 1; 
            $book->save();
        } else {
            toastr()->timeOut(5000)->closeButton()->addError('Book not found');
            return redirect()->back();
        }

        $borrow->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('Book successfully marked as returned');
    } else {
        toastr()->timeOut(5000)->closeButton()->addError('Invalid status for returning the book');
    }

    return redirect()->back();
}









public function book_details($id)
{
    $books=Book::find($id);
    if (!$books) {
        toastr()->timeOut(5000)->closeButton()->addError('Book not found');
        return redirect()->back();
    }

   
    

    // Pass the book data to the view
    return view('user.book_details',compact('books'));
}
public function explore(){


     
   $book = Book::orderBy('title', 'asc')->paginate(6);
    return view('user.explore',compact('book'));
}
public function search(Request $request){

  
    $search = $request->input('search');

    // Fetch and sort books by title and author name (ascending order) 
    $books = Book::orderBy('title', 'asc')->orderBy('author_name', 'asc')->get();

    // Convert the collection to an array for binary search 118-193
    $booksArray = $books->toArray();

    // Use binary search to find the range of matching books
    $matchedBooks = $this->searchBooks($booksArray, $search);

    
    // Return the view with matched books and search term
    return view('user.explore', ['book' => $matchedBooks, 'search' => $search]);
}

private function searchBooks($books, $search)
{
    $matchedBooks = [];

    // Search by title
    $titles = array_column($books, 'title');
    $matchedBooks = array_merge($matchedBooks, $this->binarySearch($titles, $search, 'title', $books));

    // Search by author name
    $authors = array_column($books, 'author_name');
    $matchedBooks = array_merge($matchedBooks, $this->binarySearch($authors, $search, 'author_name', $books));

    // Remove duplicate books if any
    $matchedBooks = array_unique($matchedBooks, SORT_REGULAR);

    return $matchedBooks;
}

private function binarySearch($data, $search, $field, $books)
{
    $matchedBooks = [];
    $low = 0;
    $high = count($data) - 1;

    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);
        $comparison = stripos($data[$mid], $search);

        if ($comparison !== false) {
            // Add matched book
            $matchedBooks[] = $books[$mid];

            // Look for additional matches on both sides of the midpoint
            $left = $mid - 1;
            $right = $mid + 1;

            // Find all matching on the left side
            while ($left >= 0 && stripos($data[$left], $search) !== false) {
                $matchedBooks[] = $books[$left];
                $left--;
            }

            // Find all matching on the right side
            while ($right < count($data) && stripos($data[$right], $search) !== false) {
                $matchedBooks[] = $books[$right];
                $right++;
            }

            break;
        }

        if (strcasecmp($data[$mid], $search) < 0) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    return $matchedBooks;
}
}
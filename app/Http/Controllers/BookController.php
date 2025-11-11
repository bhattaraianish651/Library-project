<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public function add_book(){
        $category=Category::all();
        return view('admin.add_book',compact('category'));
    }
    public function store_book(Request $request){


        

        $book=new Book;
        $book->title=$request->book_name;
        $book->author_name=$request->author_name;
        $book->price=$request->price;
        $book->description=$request->description;
        $book->quantity=$request->quantity;
        
        $book->category_id=$request->category;
        $book_image=$request->book_img;
        $author_image=$request->author_img;
        if($book_image){
            $book_image_name=time().'.'.$book_image->getClientOriginalExtension();
            $request->book_img->move('book',$book_image_name);
            $book->book_img=$book_image_name;
        }

        if($author_image){
            $author_image_name=time().'.'.$author_image->getClientOriginalExtension();
            $request->author_img->move('author',$author_image_name);
            $book->author_img=$author_image_name;
        }






        $book->save();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Book Added Successfully');
        return redirect()->back();;

    }
    public function show_book(){
        $book=Book::paginate(3);
        return view('admin.show_book',compact('book'));
    }
    public function book_delete($id){
        $book=Book::find($id);
        $image_path=public_path('book/'.$book->book_img);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $image_path=public_path('author/'.$book->author_img);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        $book->delete();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Book Deleted Successfully');
        return redirect()->back();
    }  
    public function edit_book($id){
        $book=Book::find($id);
        $category=Category::all();
        return view('admin.edit_book',compact('book','category'));
    }
    public function update_book(Request $request,$id){
        $book=Book::find($id);
        $book->title=$request->title;
        $book->author_name=$request->author_name;
        $book->price=$request->price;
        $book->quantity=$request->quantity;
        $book->description=$request->description;
        $book->category_id=$request->category;

        $book_image=$request->book_img;
        $author_image=$request->author_img;
        if($book_image){
            $book_image_name=time().'.'.$book_image->getClientOriginalExtension();
            $request->book_img->move('book',$book_image_name);
            $book->book_img=$book_image_name;
        }

        if($author_image){
            $author_image_name=time().'.'.$author_image->getClientOriginalExtension();
            $request->author_img->move('author',$author_image_name);
            $book->author_img=$author_image_name;
        }
        $book->save();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Book Updated Successfully');
        return redirect('/show_book');

        
    }

}

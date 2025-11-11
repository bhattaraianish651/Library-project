<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function category_page(){
        // Fetch all categories as an array for easier sorting
        $categories = Category::all()->toArray();

        // Merge Sort function 11-57
        function mergeSort($array) {
            if (count($array) <= 1) {
                return $array;
            }

            $middle = floor(count($array) / 2);

            // Recursively split and sort
            $left = mergeSort(array_slice($array, 0, $middle));
            $right = mergeSort(array_slice($array, $middle));

            return merge($left, $right);
        }
         // Merge function to combine two sorted arrays
         function merge($left, $right) {
            $result = [];

            while (count($left) > 0 && count($right) > 0) {
                if ($left[0]['category_title'] <= $right[0]['category_title']) {
                    $result[] = array_shift($left);
                } else {
                    $result[] = array_shift($right);
                }
            }

            // Append remaining items
            return array_merge($result, $left, $right);
        }
          // Sort categories by 'category_title'
          $sortedCategories = mergeSort($categories);

          // Convert back to a collection (if necessary for Laravel functionality)
          $categories = collect($sortedCategories);
  
          // Pass sorted categories to the view
          return view('admin.category', compact('categories'));



          
    }
    public function add_category(Request $request){

       
        
        








        $category=new Category();
        $category->category_title=$request->category;
        $category->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Added Successfully');
        return redirect()->back();

       
        
    
      
        
    



    }
    public function delete_category($id){
        $category=Category::find($id);
        $category->delete();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Deletd Successfully');
        return redirect()->back();;
    }
    public function edit_category($id){
        $category=Category::find($id);
        return view('admin.update_category',compact('category'));
    }
    public function update_category(Request $request, $id){
        $category=Category::find($id);
        $category->category_title=$request->category_title;
        $category->save();
        
        toastr()->timeOut(5000)->closeButton()->addSuccess('Category Updated Successfully');
        return redirect('/category_page');
    }
    
}

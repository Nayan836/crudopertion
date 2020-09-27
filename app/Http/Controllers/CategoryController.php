<?php

namespace App\Http\Controllers;
use \App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function AllCat(){
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index',compact('categories'));
    }
    public  function AddCat(Request $request){

         $request->validate([
            'category_name' => 'required|max:255',

        ],
                 ['category_name.required' => 'Please Input Category Name',
      ]);

         Category::insert([
             'category_name' => $request->category_name,
             'user_id' => Auth::user()->id,
             'created_at' => Carbon::now()
         ]);
          return redirect()->back()->with('success','Category inserted');
    }
}

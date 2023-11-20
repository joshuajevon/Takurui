<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function createCategory(){
        $cart_count = Cart::count();
        return view('admin.product.createCategory', compact('cart_count'));
    }

    public function storeCategory(Request $request){

        $request->validate([
            'category_name' => 'required|unique:categories,category_name,except,id',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->category_name,'-'),
        ]);
        return redirect('/admin/product');
    }
}

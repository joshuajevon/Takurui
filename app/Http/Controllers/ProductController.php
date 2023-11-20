<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function welcome(Request $request){
        if($request->input('search')){
            $result = $request->input('search');
            $products = Product::where('name','like','%' .request('search'). '%')->where('stock', '>', 0)->paginate(12);
            return view('main.product', compact('products','result'));
        } else{
            $products = Product::latest()->where('stock', '>', 0)->take(4)->get();
            $limitedEdition = Product::where('category_id', 1)->where('stock', '>', 0)->take(4)->get();
        }
        $cart_count = Cart::count();
        return view('main.welcome', compact('products','limitedEdition','cart_count'));
    }

    public function product(Request $request){
        if($request->input('search')){
            $products = Product::where('name','like','%' .request('search'). '%')->where('stock', '>', 0)->paginate(12);
        } else{
            $products = Product::orderBy('created_at', 'desc')->where('stock', '>', 0)->paginate(12);
        }
        $result = $request->input('search');
        $cart_count = Cart::count();
        return view('main.product', compact('products','result','cart_count'));
    }

    public function productById($id){
        $product = Product::findOrFail($id);
        $cart_count = Cart::count();
        return view('main.productById', compact('product','cart_count'));
    }

    public function filterCat(Request $request, $id){
        if($request->input('search')){
            $products = Product::where('name','like','%' .request('search'). '%')->where('stock', '>', 0)->paginate(12);
        } else{
            $products = Product::where('category_id',$id)->where('stock', '>', 0)->paginate(12);
        }

        $result = $request->input('search');
        $cart_count = Cart::count();
        return view('main.product',compact('products','result','cart_count'));
    }

     // admin product

     public function adminProductDashboard(){
        $products = Product::all();
        $cart_count = Cart::count();
        return view('admin.product.dashboard', compact('products','cart_count'));
    }

    public function createProduct(){
        $categories = Category::all();
        $cart_count = Cart::count();
        return view('admin.product.createProduct', compact('categories','cart_count'));
    }

    public function storeProduct(Request $request){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer|min:10',
            'image' => 'required'
        ]);

        $fileName = time()  . '-' . $request->name . '-' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('/public/image', $fileName);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $fileName,
            'category_id' => $request->CategoryName,
        ]);


        return redirect('/admin/product/');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $cart_count = Cart::count();
        $categories = Category::all();
        return view('admin.product.editProduct', compact('product','cart_count','categories'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer|min:10',
        ]);

        $product = Product::findOrFail($id);
        $image = $request->file('image');

        if($image){
            Storage::delete('/public/image/'. $product->image);
            $fileName = time()  . '-' . $request->name . '-' . $request->file('image')->getClientOriginalName();
            $image->storeAs('/public/image', $fileName);
            $product->update([
                'image' => $fileName,
            ]);
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        return redirect('/admin/product/');
    }

    public function delete($id){
        Product::destroy($id);
        return redirect('/admin/product/');
    }

    public function viewProductById($id){
        $product = Product::findOrFail($id);
        $cart_count = Cart::count();
        return view('admin.product.viewProduct', compact('product','cart_count'));
    }
}

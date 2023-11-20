<?php

namespace App\Http\Controllers;

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
        return view('main.welcome', compact('products','limitedEdition'));
    }

    public function product(Request $request){
        if($request->input('search')){
            $products = Product::where('name','like','%' .request('search'). '%')->where('stock', '>', 0)->paginate(12);
        } else{
            $products = Product::orderBy('created_at', 'desc')->where('stock', '>', 0)->paginate(12);
        }
        $result = $request->input('search');

        return view('main.product', compact('products','result'));
    }

    public function productById($id){
        $product = Product::findOrFail($id);
        return view('main.productById', compact('product'));
    }

    public function filterCat(Request $request, $id){
        if($request->input('search')){
            $products = Product::where('name','like','%' .request('search'). '%')->where('stock', '>', 0)->paginate(12);
        } else{
            $products = Product::where('category_id',$id)->where('stock', '>', 0)->paginate(12);
        }

        $result = $request->input('search');
        return view('main.product',compact('products','result'));
    }

     // admin product

     public function adminProductDashboard(){
        $products = Product::all();
        return view('admin.product.dashboard', compact('products'));
    }

    public function createProduct(){
        $categories = Category::all();
        return view('admin.product.createProduct', compact('categories'));
    }

    public function storeProduct(Request $request){

        // $request->validate([
        //     'name' => 'required|unique:products,name,except,id',
        //     'descripton' => 'required',
        //     'price' => 'required|integer',
        //     'quantity' => 'required|integer|min:10',
        //     // 'image' => 'required'
        // ]);

        // $extension = $request->file('image')->getClientOriginalExtension();
        // $fileName = $request->name.'.'.$extension;
        // $request->file('image')->storeAs('/public/image', $fileName);

        $fileName = time()  . '-' . $request->name . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('/public/image', $fileName);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name,'-'),
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $fileName,
            'category_id' => $request->CategoryName,
        ]);


        return redirect('/admin/product/');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('admin.product.editProduct', compact('product'));
    }

    public function update(Request $request, $id){

        // $request->validate([
        //     'Name' => 'required',
        //     'PublicationDate' => 'required',
        //     'Stock' => 'required|integer|gt:5',
        //     'Author' => 'required|min:5',
        //     'Image' => 'required|mimes:png,jpg'
        // ]);

        $product = Product::findOrFail($id);
        $image = $request->file('image');

        if($image){
            Storage::delete('/storage/image'. $product->image);
            $fileName = time()  . '-' . $request->name . $request->file('image')->getClientOriginalName();
            $image->storeAs('/public/image', $fileName);
            $product->update([
                'image' => $fileName,
            ]);
        }

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
        ]);
        return redirect('/admin/product/');
    }

    public function delete($id){
        Product::destroy($id);
        return redirect('/admin/product/');
    }

    public function viewProductById($id){
        $product = Product::findOrFail($id);
        return view('admin.product.viewProduct', compact('product'));
    }
}

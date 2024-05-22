<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProduct(AddProductRequest $request){
        Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_image' => $request->hasFile('product_image') ? $request->file('product_image')->store('product_images') : null,
        ]);
        return response()->json(["message" => "Mahsulot muvaffaqqiyatli qo'shildi!", 'success' => true], 201);
    }

    public function updateProduct(UpdateProductRequest $request, int $productId)
    {
        $product = Product::find($productId);
        $product->update([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_image' => $request->hasFile('product_image') ? $request->file('product_image')->store('product_images') : null,
        ]);
        return response()->json(["message" => "Mahsulot o'zgartirildi!", 'success' => true], 200);
    }

    public function getProduct(){
        return Product::select('products.id', 'product_name', 'product_image', 'category_id')
        ->with('category')->paginate(15); 
    }

    public function searchProduct(){
        $search = request('search');

      return  Product::when($search, function ($query) use ($search){
            $query->where('product_name', 'like', "%$search%");
        })
        ->orderBy('products.id', 'asc')
        ->paginate(15);
    }

    public function betweenProduct(){
        $maxPrice = request('maxPrice');
        $minPrice = request('minPrice');

       return Product::join('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->when($maxPrice && $minPrice, function ($query) use ($minPrice, $maxPrice){
            $query->whereBetween('product_variants.sale_price', [$minPrice, $maxPrice]);
        })
        ->orderBy('products.id', 'asc')
        ->paginate(15);  
    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Http\Requests\AddProductVariantRequest;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    public function addProductVariant(AddProductVariantRequest $request)
    {
        ProductVariant::create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'count' => $request->count,
            'color' => $request->color,
        ]);
        return response()->json(["message" => "Mahsulot sifatlari muvaffaqqiyatli qo'shildi!", 'success' => true], 201);
    }

    public function updateProductVariant(UpdateProductVariantRequest $request, int $productVariantId)
    {
        $productVariant = ProductVariant::find($productVariantId);

        $productVariant->update([
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'count' => $request->count,
            'color' => $request->color,
        ]);
        return response()->json(["message" => "Mahsulot sifatlari o'zgartirildi!", 'success' => true], 200);
    }

    public function getProductVariant()
    {
        return ProductVariant::join('products', 'products.id', '=', 'product_variants.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->orderBy('products.id', 'asc')
            ->paginate(15);
    }

    public function discount(DiscountRequest $request, $productVariantId)
    {
          $productVariant =  ProductVariant::find($productVariantId);

        $productVariant->discount_price -= $productVariant->sale_price / 100 * $request->discount;
        $productVariant->discount = $request->discount;
        $productVariant->discount_date = $request->discount_date;
        $productVariant->active_discount = true;
        $productVariant->save();

        return response()->json(["message" => "Mahsulot $request->discount foizda $request->discount_date kunigacha chegirmaga qo'yildi!"], 200);
    }

    public function getDiscountProduct()
    {
        return ProductVariant::select('id', 'product_id', 'discount_price', 'discount', 'count', 'color')
        ->where('active_discount', true)->orderBy('id', 'asc')->paginate(15);
    }
}

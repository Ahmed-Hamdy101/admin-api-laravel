<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
   }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $product = Product::create($request->only('title', 'description','image', 'price') );
        return response(new ProductResource($product), Response::HTTP_CREATED);
    }


    public function update(Request $request, string $id)
    {
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
   }
}

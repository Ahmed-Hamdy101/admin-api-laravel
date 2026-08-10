<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function index()
    {
        //  req gates for view  Products
        Gate::authorize('view', Product::class);
        $products = Product::paginate(10);
        return ProductResource::collection($products);
   }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //  req gates for view  one single Products
        Gate::authorize('view', Product::class);
        $product = Product::findOrFail($id);
        return new ProductResource($product);
    }

    /**
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        //  req gates for add  Products
        Gate::authorize('edit', Product::class);
        $product = Product::create($request->only('title', 'description','image', 'price') );
        return response(new ProductResource($product), Response::HTTP_CREATED);
    }


    public function update(ProductCreateRequest $request, string $id)
    {
        //  req gates for update  Products
        Gate::authorize('edit', Product::class);
        $product = Product::findOrFail($id);
        $product->update($request->only('title', 'description', 'image', 'price'));
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  req gates for delete  Products
        Gate::authorize('edit', Product::class);
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted successfully'], Response::HTTP_OK);
    }
}

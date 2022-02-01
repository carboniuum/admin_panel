<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        return new ProductResource(Product::find($id));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED );
    }

    public function destroy($id)
    {
        Product::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

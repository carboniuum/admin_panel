<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @OA\Get(path="/api/products",
     *     @OA\Response(response="200",
     *      description="Product Collection"
     *     )
     * )
     */
    public function index()
    {
        Gate::authorize('view', 'products');

        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show($id)
    {
        Gate::authorize('view', 'products');

        return new ProductResource(Product::find($id));
    }

    public function store(Request $request)
    {
        Gate::authorize('edit', 'products');

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
        Gate::authorize('edit', 'products');

        $product = Product::find($id);

        $product->update($request->only('title', 'description', 'image', 'price'));

        return response($product, Response::HTTP_ACCEPTED );
    }

    public function destroy($id)
    {
        Gate::authorize('edit', 'products');

        Product::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

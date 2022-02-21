<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($request->has('id')) {
            $product = Product::find($request['id']);
            $arr = explode('/', $product->image);
            if (Storage::exists('images/' . end($arr))) {
                Storage::delete('images/' . end($arr));
            }
        }

        $file = $request->file('image');
        $name = Str::random(10);
        $url = Storage::putFileAs('images', $file, $name . '.' . $file->extension());

        return [
            'url' => env('APP_URL') . '/' . $url,
        ];
    }
}

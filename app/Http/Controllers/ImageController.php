<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    public function upload(ImageUploadRequest $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('image');
        $filename = Str::random(10) . '.' . $file->extension();

        $destination = public_path('images');
        if (!file_exists($destination)) {
            mkdir($destination, 0777, true);
        }
        $file->move($destination, $filename);
        $url = env('APP_URL') . '/images/' . $filename;
        return response()->json([
            'filename' => $filename,
            'url' => $url,
        ], Response::HTTP_CREATED);
    }
}

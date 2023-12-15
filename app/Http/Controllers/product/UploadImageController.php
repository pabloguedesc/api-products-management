<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UploadImageController extends Controller
{
  public function uploadImage(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'image' => 'required|image',
    ]);

    if ($validator->fails()) {
      return response()->json(['errors' => $validator->errors()], 422);
    }

    if ($request->hasFile('image')) {
      $image = $request->file('image');
      $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
      $path = $image->storeAs('images', $imageName, 'public');

      return response()->json(['path' => $path], 200);
    }

    return response()->json(['message' => 'No file uploaded'], 400);
  }
}

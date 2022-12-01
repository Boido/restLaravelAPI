<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\apiModel;

class CategoryController extends Controller
{
   
    public function index()
    {
        $posts = Category::latest()->get();

        return response([
            'success' => true,
            'message' => 'List Semua Posts',
            'data' => $posts,
        ], 200);
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $image_path = $request->file("category_image")->store('image', 'public');

        $post = Category::create([
            'category_name' => $request->category_name,
            'category_image' => $image_path,
            'category_id' => $request->category_id,
        ]);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Berhasil Disimpan',
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Post Gagal Disimpan!'
        ], 400);
    }

   
    public function show($id)
    {
        $post = Category::whereId($id)->get()->load(['apiModel']);

        if($post){
            return response ()->json([
                'success'=> true,
                'message'=> 'Detail Post',
                'data'=> $post
            ], 200);
        }else {
            return response ()->json([
                'success'=> false,
                'message'=> 'Post Tidak Ditemukan',
                'data'=> $post
            ], 404);
        }
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $post = Category::findOrFail($id);

        if ($post) {
            $post->update([
                'category_name' => $request->category_name,
                'category_image' => $request->category_image,
                'category_id' => $request->category_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post telah di Update',
                'data' => $post
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Post tidak di temukan',
            'data' => $post
        ], 400);
    }

   
    public function destroy($id)
    {
        $product = Category::find($id);

        if ($product) {
            $product->delete();

            return response()->json([
                'message' => 'Product berhasil di Hapus',
                'code' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Product dengan id $id tidak tersedia',
                'code' => 400
            ]);
        }
    }
}

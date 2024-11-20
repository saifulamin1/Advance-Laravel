<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
     // 1. Menampilkan semua data
     public function index()
     {
         return Post::all();
     }
 
     // 2. Menyimpan data baru
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required',
             'content' => 'required',
         ]);
 
         $post = Post::create($request->all());
         return response()->json($post, 201);
     }
 
     // 3. Menampilkan data berdasarkan ID
     public function show($id)
     {
         $post = Post::find($id);
 
         if (!$post) {
             return response()->json(['message' => 'Data not found'], 404);
         }
 
         return $post;
     }
 
     // 4. Memperbarui data
     public function update(Request $request, $id)
     {
         $post = Post::find($id);
 
         if (!$post) {
             return response()->json(['message' => 'Data not found'], 404);
         }
 
         $post->update($request->all());
         return response()->json($post);
     }
 
     // 5. Menghapus data
     public function destroy($id)
     {
         $post = Post::find($id);
 
         if (!$post) {
             return response()->json(['message' => 'Data not found'], 404);
         }
 
         $post->delete();
         return response()->json(['message' => 'Data deleted successfully']);
     }
}

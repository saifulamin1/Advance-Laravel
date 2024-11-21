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
        // $post = Post::create([
        //     'en' => [
        //         'title' => 'Title in English',
        //         'content' => 'Description in English',
        //     ],
        //     'ft' => [
        //         'title' => 'Title in Français',
        //         'content' => 'Description en Français',
        //     ],
        // ]);
        $request->validate([
            'langs.id'       => 'required|array',
            'langs.en'       => 'nullable|array',
            'langs.id.title'        => 'required|string',
            'langs.id.content' => 'required|string',
            'langs.en.title'        => 'string|nullable',
            'langs.en.content' => 'string|nullable',
        ]);

        $id = $request["langs"]["id"] ?? null;
        $en = $request["langs"]["en"] ?? null;
        
        if(isset($id)){
            $data["id"] = [
                "title" => $request["langs"]["id"]["title"],
                "content" => $request["langs"]["id"]["content"]
            ];
        }
        if(isset($en)){
            $data["en"] = [
                "title" => $request["langs"]["en"]["title"],
                "content" => $request["langs"]["en"]["content"]
            ];
        } 

        $result = Post::create($data);
         return response()->json($result, 201);
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

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->params['perPage'] ?: 10;
        $query = $request->params['search'] ?: '';

        $posts = Post::with([
            'creator'
        ])->when($query, function($q) use ($query) {
            $q->where(function($q2) use ($query) {

            });
        })
        ->get();



        return $posts->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'user_uuid' => 'required'
        ], [
            'name.required' => 'El nombre es requerido',
            'description.required' => 'La descripción es requerida',
            'user_uuid.required' => 'El usuario es requerido'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 422);
        }

        try {
            $post = Post::create([
                'name' => $request->name,
                'description' => $request->description,
                'user_uuid' => $request->user_uuid
            ]);
        
            return response()->json([
                'status' => true,
                'message' => '!Post creado correctamente!'
            ], 200);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ocurrio un error: ' . $e->getMessage()
            ], 500);
        }   

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function getPostsByUser($user_uuid)
    {
        try {
            $posts = Post::where('user_uuid', $user_uuid)->get();

            return $posts;
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    } 
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required',
            'post_uuid' => 'required|exists:posts,uuid'
        ], [
            'comment.required' => 'El comentario es requerido',
            'post_uuid.required' => 'El post es requerido',
            'post_uuid.exists' => 'El post seleccionado no existe'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 422);
        }

        try {
            Comment::create([
                'comment' => $request->comment,
                'post_uuid' => $request->post_uuid
            ]);

            return response()->json([
                'status' => true,
                'message' => '!Comentario creado exitosamente!'
            ]);
            
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Ocurrio un error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}

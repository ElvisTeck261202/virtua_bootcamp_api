<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query = $request->get('search', null);

        $users = User::query();
        
        $users->select('uuid', 'name', 'email', 'created_at', 'updated_at')->with(['roles']);

        if ($query) {
            $users->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%")
                  ->orWhere('email', 'LIKE', "%$query%");
            });
        }
    
        $users = $users->orderBy($sortBy, $sortOrder)->paginate($perPage);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'name' => 'required|string', 
            'email' => 'required|string', 
            'password' => 'required',
        ]);

        $user = User::create([ 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado exitosamente.',
            'data' => $user->only(['uuid', 'name', 'email'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([ 
            'name' => 'required|string', 
            'email' => 'required|string',
            'password' => 'string|nullable',
        ]);
    
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->name = $request->name; 
        $user->email = $request->email; 
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado.',
            'data' => $user->only(['uuid', 'name', 'email'])
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        $user->delete();
        return response()->json(null, 204);
    }
}

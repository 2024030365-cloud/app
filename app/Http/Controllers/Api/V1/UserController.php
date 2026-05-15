<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($success = true, $data = null, $message = 'obtenido correctamente', $code = 200)
    {
     

        return SuccesResponse(true, UserResource::collection(User::all()), 'obtenido correctamente', 200);
    }
    
    public function store(Request $request)
    {
         $user = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();
    
    if (!$user || $user->role !== 'superadmin') {
      //  return response()->json(['message' => 'Unauthorized'], 403);
          return ErrorResponse(false, 'Unauthorized', 401);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ]);

    $newUser = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // return new UserResource($newUser);
     return SuccesResponse(true, new UserResource($newUser), 'Usuario creado correctamente', 201);
    
    }
    public function show(User $user)
    {
        // return new UserResource($user);
        return SuccesResponse(true, new UserResource($user), 'obtenido correctamente', 200);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:central.users,email,' . $user->id,        ]);

        $user->update($request->all());

        // return new UserResource($user);
        return SuccesResponse(true, new UserResource($user), 'Usuario actualizado correctamente', 200);
    }

    public function destroy(User $del)
    {
    $user = \PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth::parseToken()->authenticate();

    if (!$user || $user->role !== 'superadmin') {
    // return response()->json(['message' => 'Unauthorized'], 403);
       return ErrorResponse(false, 'Unauthorized', 401);
    }

    $del->delete();
        return SuccesResponse(true, null, 'Usuario eliminado correctamente', 200);
        //return response()->noContent();
    }
}
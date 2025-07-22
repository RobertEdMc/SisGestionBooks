<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     * Display the specified resource.
    */
    public function show(Request $request)
    {
        $user = $request->user();
        if (!$user){
            return response()->json(['message' => 'No autenticado o sesion expirada'], 401);
        }
        return response()->json([
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ]);
    }
}

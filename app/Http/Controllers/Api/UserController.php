<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all_user_get(Request $request)
    {
        $user = $request->user();
        if($user->hasPermissionTo('view all user'))
        {
            $user=User::role('user')->get();

            return response()->json(['user'=>UserResource::collection($user)],200);
        }else{
            return response()->json(['message'=>'you dont have permission'],403);
        }

    }


}

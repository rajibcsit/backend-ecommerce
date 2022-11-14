<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Login a authenticate User
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;

            // return response()->json([
            //     "user" => $user,
            //     'token' => $token,
            //     'message' => 'User LoggedIn Successfully',
            // ], 200);
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response, 200);
        } else {
            return response()->json([
                'error' => 'Invalid credential'
            ], 422);
        }
    }

    /**
     * User Registration
     */
    public function registration(Request $request)
    {
        $data = $request->all();

        //check unique email
        $uniqueEmail =  User::where('email', $request->email)->first();

        if ($uniqueEmail) {
            return response()->json([
                'success' => false,
                'message' => 'Email Already Exists',
            ]);
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            User::create($data);

            return response()->json([
                'success' => true,
                'message' => 'User Created Successfully',
                'data'    => $data
            ], 201);
        }
    }
}

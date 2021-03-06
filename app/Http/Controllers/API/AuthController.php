<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:5'],

    ]);
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }
    // 2

    $input = $request->all();
    $input['password'] = bcrypt($input['password']);
    $user = User::create($input);
    // 3

    $token = $user->createToken($request->email)->plainTextToken;
    // 4

    return response()->json(['token' => $token], 200);
}
    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:5'],

    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 401);
    }


    $user = User::where('email', $request->email)->first();


    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
    }
    // 3

    return response()->json(['token' => $user->createToken($request->email)->plainTextToken]);
    // 4
}

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteToken(Request $request) {
        /**
         * @var User $user
         */
   $user = $request->user();
   $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
   return response()->json(['user'=>$user->id]);
    }
    public  function getUserInfo(Request $request) {
        return response()->json(['name' => $request->user()->name,
            'role'=> $request->user()->role]);
    }


}

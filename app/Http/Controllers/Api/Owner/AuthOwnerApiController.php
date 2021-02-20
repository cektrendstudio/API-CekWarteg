<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



class AuthOwnerApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['index']]);


    }

    public function index(Request $request)
    {
        Config::set('jwt.user', 'App\Warteg');
        Config::set('auth.providers.users.model', \App\Warteg::class);

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "iSuccess" => false,
                "messages"  => $validator->errors()],
                401);
        }
        $credentials = $request->only('username', 'password');



        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json([
                "iSuccess" => false,
                'messages' => 'Unauthorized'
            ], 403);
        }


        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        Config::set('jwt.user', 'App\Warteg');
        Config::set('auth.providers.users.model', \App\Warteg::class);

        return response()->json([
            "isSuccess" => true,
            "data"  =>  auth('api')->user(),
        ],200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {


        if (!empty($request->header('Authorization'))) {
            auth('api')->logout();
        }

        return response()->json([
            'messages'  => "Success Logout"
        ],201);
    }



    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => "Bearer " . $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }


}

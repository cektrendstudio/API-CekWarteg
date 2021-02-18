<?php

namespace App\Http\Controllers\Api;

use App\Warteg;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WartegApiController extends Controller
{
    public function index(){
        $warteg = Warteg::where('is_active', true)->get();

        return response()->json([
            'isSuccess' => true,
            'data' => $warteg
        ],200);
    }

    public function create(Request $request){
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required|string|min:6',
                'username'  => 'required|string|min:6',
                'password'  => 'required|string|min:6',
                'ownerName' => 'required|string|min:3',
                'address'   => 'required|string|min:8',
                'description'  => 'required|string|min:6',
                'phone'  => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }


        $create = Warteg::create(
            [
                "username" => strtolower(preg_replace('/\s+/', '', $request->username)),
                "password" => Hash::make($request->password),
                "code" => "WTG" . time(),
                "name" => $request->name,
                "owner_name" => $request->ownerName,
                "address" => $request->address,
                "phone" => $request->phone,
                "description" => $request->description,
                "photo_profile" => "wartegs/5eI2ewJf9Q3fzg2trMWBpINI66lV3iZXXzRPXUmd.png",
            ]);

        if($create){
            return response()->json([
                'isSuccess' => true,
                'data' => $create
            ],201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save',
        ], 409);


    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Warteg;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WartegApiController extends Controller
{
    public function index(){
        $warteg = Warteg::with('menu')->get();

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
                'photo' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }

        try{
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
                    "photo_profile" => ENV('BASE_IMAGE') .$request->file('photo')->store('wartegs', 'public'),
                ]);

            if($create){
                return response()->json([
                    'isSuccess' => true,
                    'data' => $create,
                    'message'   => "Success create warteg account!"
                ],201);
            }

            return response()->json([
                'success' => false,
                'message' => 'Ops failed create Warteg account',
            ], 409);
        }catch (QueryException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Ops failed create Warteg account ' . $exception->getCode(),
            ], 500);
        }



    }
    public function show($id)
    {

        $warteg = Warteg::where('id', $id)->with('menu')->first();

        return response()->json([
            'isSuccess' => true,
            'data' => $warteg
        ],200);
    }

    public function update(Request $request, Warteg $warteg, $id)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|min:6',
            'ownerName' => 'required|string|min:3',
            'address'   => 'required|string|min:8',
            'description'  => 'required|string|min:6',
            'phone'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }

        //find post by ID
        $warteg = Warteg::findOrFail($id);

        if(!$warteg) {


        return response()->json([
            'success' => false,
            'message' => 'Warteg Not Found',
        ], 404);

        }
        try{


            //update post
            $warteg->update([
                "code" => "WTG" . time(),
                "name" => $request->name,
                "owner_name" => $request->ownerName,
                "address" => $request->address,
                "phone" => $request->phone,
                "description" => $request->description,
                "photo_profile" => ENV('BASE_IMAGE') .$request->file('photo')->store('wartegs', 'public'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Warteg Success Updated!',
                'data'    => $warteg
            ], 200);
        }catch (QueryException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Ops failed update Warteg account ' . $exception->getCode(),
            ], 500);
        }


    }
}

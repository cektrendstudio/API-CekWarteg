<?php

namespace App\Http\Controllers\Api\Owner;

use App\Menu;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class MenuWartegOwnerApiController extends Controller
{
    public function __construct()
    {
        Config::set('jwt.user', 'App\Warteg');
        Config::set('auth.providers.users.model', \App\Warteg::class);
    }

    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required|string',
                'description'  => 'required|string|min:8',
                'price' => 'required|numeric',
                'isHaveStock' => 'required|boolean',
                'photo' => 'required|image',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }


        try{

            $create = Menu::create([
                'code'  => "MN-" . auth('api')->user()->id .time(),
                'name'  => $request->name,
                'description' => $request->description,
                'warteg_id' => auth('api')->user()->id,
                'price'=> $request->price,
                'is_have_stock'=> $request->isHaveStock,
                'photo' => ENV('BASE_IMAGE') .$request->file('photo')->store('menus', 'public'),
            ]);

            if($create){
                return response()->json([
                    'isSuccess' => true,
                    'data' => $create,
                    'message'   => "Success create menu!"
                ],201);
            }

            return response()->json([
                'success' => false,
                'message' => 'Ops failed create menu',
            ], 409);
        }catch (QueryException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Ops failed create menu ' . $exception->getCode(),
            ], 500);
        }
    }
}

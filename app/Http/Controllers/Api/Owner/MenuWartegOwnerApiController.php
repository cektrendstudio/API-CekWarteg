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
        $defaultPhoto = "https://cintaihidup.com/wp-content/uploads/2017/05/17596688_1224042657715403_9172816067007873024_n-700x700.jpg";
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required|string',
                'description'  => 'required|string|min:8',
                'price' => 'required|numeric',
                'isHaveStock' => 'required|boolean',
//                'photo' => 'required|image',
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
                'photo' => $request->file('photo') == null ? $defaultPhoto : ENV('BASE_IMAGE') .$request->file('photo')->store('menus', 'public'),
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

    public function update(Request $request, $id)
    {
        //find post by ID
        $menu = Menu::where('id',$id)->where('warteg_id', auth('api')->user()->id)->first();

        if(!$menu) {

            return response()->json([
                'isSuccess' => false,
                'message' => 'Menu Not Found',
            ], 404);

        }

        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required|string',
                'description'  => 'required|string|min:8',
                'price' => 'required|numeric',
                'isHaveStock' => 'required|boolean',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }

        $photo = $request->file('photo') == null ? $menu->photo:ENV('BASE_IMAGE') .$request->file('photo')->store('menus', 'public');

        try{
            $menu->update([
                'name'  => $request->name,
                'description' => $request->description,
                'price'=> $request->price,
                'is_have_stock'=> $request->isHaveStock,
                'photo' => $photo,
            ]);

            return response()->json([
                'isSuccess' => true,
                'message' => 'Success updated menu!',
                'data'  => $menu,
            ], 201);
        }catch (QueryException $exception){
            return response()->json([
                'isSuccess' => false,
                'message' => 'Ops failed update menu ' . $exception->getCode(),
            ], 500);
        }
    }

    public function delete($id)
    {
        $menu = Menu::find($id);

        if($menu){
            try{
                $menu->delete();
                return response()->json([
                    'isSuccess' => true,
                    'messages'   => 'Success delete menu!',
                    'data'  => $menu,
                ],201);

            }catch (QueryException $exception){
                return response()->json([
                    'isSuccess' => false,
                    'messages'   => 'failed to delete menu! ' . $exception->getCode(),
                    'data'  => $menu,
                ],201);
            }

        }

        return response()->json([
            'isSuccess' => false,
            'messages'  => 'Unknown menu'
        ],400);
    }
}

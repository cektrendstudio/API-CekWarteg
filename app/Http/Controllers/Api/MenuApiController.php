<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Menu;
use App\Review;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuApiController extends Controller
{
    public function index()
    {
        $menu = Menu::with('warteg')->get();
        return response()->json([
            'isSuccess' => true,
            'elements'  => $menu->count(),
            'data' => $menu
        ],200);
    }

    public function show($id)
    {
        $menu = Menu::where('id', $id)->with('warteg')->with('review')->first();
        return response()->json([
            'isSuccess' => true,
            'data' => $menu
        ],200);
    }
    public function createReview(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(), [
                'name'  => 'required|string',
                'reviewText'  => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }


        try{

            $create = Review::create([
                'code'  => "RE-" . $id .time(),
                'menu_id'  => $id,
                'name'  => $request->name,
                'review_text' => $request->reviewText,
            ]);

            if($create){
                return response()->json([
                    'isSuccess' => true,
                    'data' => $create,
                    'message'   => "Success add review on menu!"
                ],201);
            }

            return response()->json([
                'success' => false,
                'message' => 'Ops failed add review on menu',
            ], 409);
        }catch (QueryException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Ops failed add review on menu ' . $exception->getCode(),
            ], 500);
        }
    }

    public function menuByWarteg($id)
    {
        $menu = Menu::where('warteg_id', $id)->with('review')->get();
        return response()->json([
            'isSuccess' => true,
            'elements'  => $menu->count(),
            'data' => $menu
        ],200);
    }
}

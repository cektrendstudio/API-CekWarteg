<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Warteg;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WartegOwnerApiController extends Controller
{
    public function update(Request $request, Warteg $warteg)
    {
        $warteg = Warteg::find(auth('api')->user()->id);

        if(!$warteg){
            return response()->json([
                'isSuccess' => false,
                'message' => 'Warteg Not Found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|min:6',
            'email' => 'required|unique:wartegs,email,'.$warteg->id.',id',
            'ownerName' => 'required|string',
            'address'   => 'required|string|min:8',
            'phone'  => 'required|numeric',
            'description'  => 'required|string|min:6',

        ]);

        if ($validator->fails()) {
            return response()->json([
                "isSuccess" => false,
                "messages"  => $validator->errors(),
            ],400);
        }

        $photo = $request->file('photo') == null ? $warteg->photo_profile:ENV('BASE_IMAGE') .$request->file('photo')->store('wartegs', 'public');

        try{
            $warteg->update([
                'name'  => $request->name,
                'email' => $request->email,
                'owner_name'    => $request->ownerName,
                'address'   => $request->address,
                'phone' => $request->phone,
                'description' => $request->description,
                'photo_profile' => $photo,

            ]);

            return response()->json([
                "isSuccess" => true,
                "messages"  => "Success Update Waretg!",
                "data"  => $warteg,
            ],201);
        }catch (QueryException $exception){
            return response()->json([
                'success' => false,
                'message' => 'Ops failed update Waretg ' . $exception->getCode(),
            ], 500);
        }

    }
}

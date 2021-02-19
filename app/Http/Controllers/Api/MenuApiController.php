<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Menu;
use Illuminate\Http\Request;

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
        $menu = Menu::where('id', $id)->with('warteg')->first();
        return response()->json([
            'isSuccess' => true,
            'elements'  => $menu->count(),
            'data' => $menu
        ],200);
    }
}

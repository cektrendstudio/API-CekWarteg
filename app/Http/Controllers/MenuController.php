<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Warteg;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $warteg = Warteg::where('is_active', true)->get();
        return view('menu.create', compact('warteg'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'  => 'required|string',
            'description'  => 'required|string',
            'warteg_id' => 'required',
            'price'   => 'required|numeric',
            'is_have_stock'  => 'required',
            'photo'  => 'required',
        ]);

        $menu = new Menu();
        $menu->code = "MN-" . $request->warteg_id .time();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->warteg_id = $request->warteg_id;
        $menu->price = $request->price;
        $menu->is_have_stock = $request->is_have_stock;
        $menu->photo =  ENV('BASE_IMAGE') .$request->file('photo')->store('menus', 'public');
        $menu->save();

        return redirect()->route('menu.create');
    }
}

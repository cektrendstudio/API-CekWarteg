<?php

namespace App\Http\Controllers;

use App\Warteg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WartegController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $warteg = Warteg::where('is_active', true)->get();
        return view('warteg.index', compact('warteg'));
    }

    public function edit($id){
        $warteg = Warteg::where('id', $id)->where('is_active', true)->first();
    }

    public function destroy($id){
        $warteg = Warteg::where('id', $id)->first();
        $warteg->is_active = false;
        $warteg->save();

        return redirect()->route('warteg.index');
    }

    public function show($id){

    }

    public function create(){
        return view('warteg.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username'  => 'required|string|min:6',
            'password'  => 'required|string|min:6',
            'ownerName' => 'required|string|min:3',
            'address'   => 'required|string|min:8',
            'phone'  => 'required',
            'photo'  => 'required',
        ]);

        $warteg = new Warteg();
        $warteg->username = strtolower(preg_replace('/\s+/', '', $request->username));
        $warteg->password = Hash::make($request->password);
        $warteg->code = "WTG" . time();
        $warteg->name = $request->name;
        $warteg->owner_name = $request->ownerName;
        $warteg->address = $request->address;
        $warteg->phone = $request->phone;
        $warteg->description = $request->description;
        $warteg->photo_profile =  $request->file('photo')->store('wartegs', 'public');
        $warteg->save();

        return redirect()->route('warteg.index');
    }
}

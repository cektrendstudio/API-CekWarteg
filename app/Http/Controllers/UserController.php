<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('is_active', true)->get();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id){
        $user = User::where('id',$id)->first();
        return view('user.edit', compact('user'));

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_active = false;
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'  => 'required|string|min:6',
            'password'  => 'required|string|min:6'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username'  => 'required|string|min:6',
            'password'  => 'required|string|min:6'
        ]);

        $user = User::where('id', $id)->first();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.index');

    }
}

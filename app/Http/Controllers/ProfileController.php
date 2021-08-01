<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Contracts\Validation\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $profile = User::where('id', Auth::user()->id)->first();
        return view('profile', compact('profile'));
    }
    public function update(Request $request){
        $profile = User::where('id', Auth::user()->id)->first();

        $this->validate($request,[
            'password' => 'confirmed'
        ]);

        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->nohp = $request->nohp;
        $profile->alamat = $request->alamat;
        if(!empty($request->password)){
            $profile->password = Hash::make($request->password);
        }
        $profile->update();

        return redirect('profile');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAction;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLog(){
        return view('pages.auth.login');
    }

    public function logIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=> 'required|min:4'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if(!$user){
            return redirect()->back()->withErrors(['email'=>'No user found!']);
        }
        if(!Hash::check($password, $user->password)){
            return redirect()->back()->withErrors( ['password'=>'Wrong password!'])->onlyInput('email');
        }

        $action = new UserAction();
        $action->user_id = $user->id;
        $action->action = 'login';
        $action->action_time = Carbon::now();
        $action->ip_address = $request->ip();
        $action->device_type = $action->getDeviceType($request->header('User-Agent'));
        $action->browser = $action->getBrowser($request->header('User-Agent'));

        $action->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout(Request $request){

        $user = Auth::user();
        $action = new UserAction();
        $action->user_id = $user->id;
        $action->action = 'logout';
        $action->action_time = Carbon::now();
        $action->ip_address = $request->ip();
        $action->device_type = $action->getDeviceType($request->header('User-Agent'));
        $action->browser = $action->getBrowser($request->header('User-Agent'));

        $action->save();
        Auth::logout();
        return redirect()->back();
    }
}

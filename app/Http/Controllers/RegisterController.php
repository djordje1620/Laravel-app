<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showReg(){
        return view('pages.auth.registration');
    }

    public function register(RegisterRequest $request){

        $data = $request->validated();
        $data['role_id'] = 1;
        $user = User::create($data);
        $userId = $user->id;

        $action = new UserAction();
        $action->user_id = $userId;
        $action->action = 'registration';
        $action->action_time = Carbon::now();
        $action->ip_address = $request->ip();
        $action->device_type = $action->getDeviceType($request->header('User-Agent'));
        $action->browser = $action->getBrowser($request->header('User-Agent'));
        $action->save();

        return redirect()->route('login');
    }
}

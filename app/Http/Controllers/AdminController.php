<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Social;
use App\Models\UserAction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $sortType = "";
        $actions = UserAction::with('user')->get();
        $messages = Message::all();
        return view('pages.admin.admin-panel', ['messages'=>$messages,'actions'=>$actions,'sortType'=>$sortType, ]);
    }

    public function statistics(Request $request){
        $actions = UserAction::all();

        if ($request->ajax()) {
            return response()->json([
                'actions' => $actions
            ]);
        }
    }

    public function sort(Request $request){
        $sortType = $request->input('sort');
        $messages = Message::all();
        $actions = UserAction::with('user')
            ->join('users as u', 'user_actions.user_id', '=', 'u.id')
            ->orderBy('user_actions.action_time', $sortType)
            ->get();

        return view('pages.admin.admin-panel', ['messages'=>$messages, 'actions'=>$actions, 'sortType'=>$sortType]);
    }
}

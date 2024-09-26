<?php

namespace App\Http\Controllers;

use App\Models\Screen;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index(){
        return view('pages.admin.admin-screen');
    }

    public function show(){

        $screens = Screen::all();

        return response()->json([
            'screens' => $screens
        ]);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'screen_name' => 'required|string|max:255',
        ]);

        $screen = new Screen();
        $screen->screen = $validatedData['screen_name'];
        $screen->save();

        return redirect()->back()->with('success', 'Screen successfully added!');
    }

    public function delete($id){
        try {
            $screen = Screen::find($id);
            if(!$screen){
                return redirect()->route('admin.screen')->with('success', 'Screen not found.');
            }
            if ($screen->product()->exists()) {
                return redirect()->route('admin.screen')->with('error', 'Cannot delete screen because it is associated with one or more products.');
            }
            $screen->delete();
            return redirect()->route('admin.screen')->with('success', 'Screen successfully deleted.');

        }catch (\Exception $e){
            return redirect()->route('admin.screen')->with('error', $e->getMessage());
        }
    }
}

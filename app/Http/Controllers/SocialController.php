<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Mockery\Exception;

class SocialController extends Controller
{
    public function index(){
       return view('pages.admin.admin-social');
    }

    public function show(){
        $socials = Social::all();
        return response()->json([
            'socials' => $socials,
        ]);
    }

    public function add(Request $request){
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'link' => 'required|url|max:255',
                'icon' => 'required|string|max:255',
            ]);

            Social::create([
                'name' => $validatedData['name'],
                'link' => $validatedData['link'],
                'iClass' => $validatedData['icon'],
                'active' => 1,
            ]);

            return redirect()->back()->with('success', "Success add");
        }catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function deactivate($id){
        try {
            $social_id = $id;
            $social = Social::find($social_id);
            if (!$social) {
                return back()->with('error', 'Social network not found.');
            }

            $social->active = 0;
            $social->save();

            return redirect()->route('admin.social')->with('success','Deactivated successfully');

        }catch (\Exception $e) {
            return back()->with('error', 'Failed to inactive. ' . $e->getMessage())->withInput();
        }
    }

    public function activate($id){
        try {
            $social_id = $id;
            $social = Social::find($social_id);
            if (!$social) {
                return back()->with('error', 'Social network not found.');
            }

            $social->active = 1;
            $social->save();

            return redirect()->route('admin.social')->with('success','Activated successfully');

        }catch (\Exception $e) {
            return back()->with('error', 'Failed to inactive. ' . $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        $social = Social::find($id);
        if ($social) {
            $social->delete();

            return redirect()->route('admin.social')->with('success', 'Successful.');
        } else {
            return redirect()->route('admin.social')->with('error', 'No social network found.');
        }
    }


}

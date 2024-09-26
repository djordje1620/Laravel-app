<?php

namespace App\Http\Controllers;

use App\Models\AboutInfo;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $aboutInfo = AboutInfo::all();
        return view('pages.main.about',["aboutInfo"=>$aboutInfo]);
    }

    public function show(){
        $aboutInfo = AboutInfo::all();
        return view('pages.admin.admin-about-info',["aboutInfo"=>$aboutInfo]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'info_id' => 'required|integer',
                'info_title' => 'required|string|max:255',
                'info_description' => 'required|string',
            ]);

            $aboutInfo = AboutInfo::find($request->input('info_id'));
            $aboutInfo->title = $request->input('info_title');
            $aboutInfo->description = $request->input('info_description');
            $aboutInfo->save();

            return redirect()->route('admin.about-info')->with('success','Successful update.');

        }catch (\Exception $e){
            return redirect()->route('admin.about-info')->with('error', $e->getMessage());
        }
    }

}

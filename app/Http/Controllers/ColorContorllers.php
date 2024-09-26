<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorContorllers extends Controller
{
    public function index(){
        return view('pages.admin.admin-color');
    }

    public function show(){

        $colors = Color::all();

        return response()->json([
            'colors' => $colors
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'color_name' => 'required|string|max:255',
                'hex' => 'required|string|min:4|regex:/^#[0-9A-Fa-f]{6}$/',
            ]);
            Color::create([
                'value' => $validatedData['color_name'],
                'hex' => $validatedData['hex'],
            ]);
            return redirect()->back()->with('success', 'Color successfully added.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error adding the color: ' . $e->getMessage());
        }
    }

    public function delete($id){
        try {
            $color = Color::find($id);
            if(!$color){
                return redirect()->route('admin.color')->with('success', 'Color not found.');
            }
            if ($color->products()->exists()) {
                return redirect()->route('admin.color')->with('error', 'Cannot delete color because it is associated with one or more products.');
            }
            $color->delete();
            return redirect()->route('admin.color')->with('success', 'Color successfully deleted.');

        }catch (\Exception $e){
            return redirect()->route('admin.color')->with('error', $e->getMessage());
        }
    }
}

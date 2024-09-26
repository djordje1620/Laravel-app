<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();

        return view('pages.admin.admin-slider',['sliders' => $sliders]);
    }

    public function activate($id){
        try {
            $slider = Slider::findOrFail($id);

            Slider::where('id', '!=', $id)->update(['activeClass' => 0]);

            $slider->activeClass = 1;
            $slider->save();

            return redirect()->route('admin.slider')->with('success', 'Slider successfully activated.');
        } catch (\Exception $e) {
            return redirect()->route('admin.slider')->with('error', $e->getMessage());
        }
    }

    public function store(Request $request){
        try {
            $validatedData = $request->validate([
                'id_slide' => 'required|exists:sliders,id',
                'title' => 'required|string|max:255',
                'subtitle' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $slider = Slider::findOrFail($validatedData['id_slide']);

            $slider->title = $validatedData['title'];
            $slider->subtitle = $validatedData['subtitle'];
            $slider->description = $validatedData['description'];
            $slider->save();

            return redirect()->route('admin.slider')->with('success', 'Slider successfully updated.');
        } catch (\Exception $e) {
            return redirect()->route('admin.slider')->with('error', $e->getMessage());
        }
    }

}

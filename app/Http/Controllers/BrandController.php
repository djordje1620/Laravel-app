<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('pages.admin.admin-brands', ['brands'=>$brands]);
    }

    public function store(Request $request){
        try {

            $validatedData = $request->validate([
                'brandName' => 'required|string|max:255',
            ]);

            $brand = new Brand();
            $brand->brand = $validatedData['brandName'];
            $brand->save();

            return redirect()->route('admin.brand')->with('success','Successful added brand.');

        }catch (\Exception $e){
            return redirect()->route('admin.brand')->with('error', $e->getMessage());
        }
    }

    public function delete(Request $request){
        try {
            $validatedData = $request->validate([
                'brand_id' => 'required|integer|exists:brands,id',
            ]);

            $brand = Brand::find($validatedData['brand_id']);

            if ($brand->product()->exists()) {
                return redirect()->route('admin.brand')->with('error', 'Cannot delete brand because it is associated with one or more products.');
            }
            $brand->delete();

            return redirect()->route('admin.brand')->with('success', 'Brand successfully deleted.');

        }catch (\Exception $e){
            return redirect()->route('admin.brand')->with('error', $e->getMessage());
        }
    }
}

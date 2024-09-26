<?php

namespace App\Http\Controllers;

use App\Models\RamMemory;
use Illuminate\Http\Request;

class RamController extends Controller
{
    public function index(){
        return view('pages.admin.admin-ram');
    }

    public function show(){

        $rams = RamMemory::all();

        return response()->json([
            'rams' => $rams
        ]);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'ram_value' => 'required|string|max:255',
        ]);

        $ramMemory = new RamMemory();
        $ramMemory->value = $validatedData['ram_value'];
        $ramMemory->save();

        return redirect()->back()->with('success', 'Ram memory successfully added!');
    }

    public function delete($id){
        try {
            $ram = RamMemory::find($id);
            if(!$ram){
                return redirect()->route('admin.ram')->with('success', 'Ram memory not found.');
            }
            if ($ram->products()->exists()) {
                return redirect()->route('admin.ram')->with('error', 'Cannot delete ram memory because it is associated with one or more products.');
            }
            $ram->delete();
            return redirect()->route('admin.ram')->with('success', 'Ram memory successfully deleted.');

        }catch (\Exception $e){
            return redirect()->route('admin.ram')->with('error', $e->getMessage());
        }
    }
}

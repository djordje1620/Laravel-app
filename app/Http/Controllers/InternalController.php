<?php

namespace App\Http\Controllers;

use App\Models\InternalMemory;
use Illuminate\Http\Request;

class InternalController extends Controller
{
    public function index(){
        return view('pages.admin.admin-internal');
    }

    public function show(){

        $internals = InternalMemory::all();
        return response()->json([
            'internals' => $internals
        ]);
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'internal_value' => 'required|string|max:255',
        ]);

        $internalMemory = new InternalMemory();
        $internalMemory->value = $validatedData['internal_value'];
        $internalMemory->save();

        return redirect()->back()->with('success', 'Internal memory successfully added!');
    }

    public function delete($id){
        try {
            $internal = InternalMemory::find($id);
            if(!$internal){
                return redirect()->route('admin.internal')->with('success', 'Internal memory not found.');
            }
            if ($internal->products()->exists()) {
                return redirect()->route('admin.internal')->with('error', 'Cannot delete internal memory because it is associated with one or more products.');
            }
            $internal->delete();

            return redirect()->route('admin.internal')->with('success', 'Internal successfully deleted.');

        }catch (\Exception $e){
            return redirect()->route('admin.internal')->with('error', $e->getMessage());
        }
    }
}

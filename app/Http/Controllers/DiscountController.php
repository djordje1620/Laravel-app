<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index(){
        $products = Product::all();
        $discounts = Discount::with('product')->get();
        return view('pages.admin.admin-discounts', ['products'=>$products, "discounts"=>$discounts]);
    }

    public function add(Request $request){
        try {
            $request->validate([
                'discount_amount' => 'required|numeric|min:0',
                'product_discount' => 'required|exists:products,id'
            ]);

            DB::beginTransaction();
            $existingDiscount = Discount::where('product_id', $request->input('product_discount'))
                ->where('active', 1)
                ->first();

            if ($existingDiscount) {
                $existingDiscount->update(['end_date' => Carbon::now(), 'active' => 0]);
            }

            $discount = new Discount();
            $discount->amount = $request->input('discount_amount');
            $discount->product_id = $request->input('product_discount');
            $discount->start_date = Carbon::now();
            $discount->active = 1;
            $discount->save();
            DB::commit();

            return redirect()->route('admin.discount')->with('success', 'Discount added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to add discount. ' . $e->getMessage())->withInput();
        }
    }

    public function active($discount, $product){

        try {

        $discount_id = $discount;
        $product_id = $product;

        $discount = Discount::find($discount_id);
         if (!$discount) {
             return back()->with('error', 'Discount not found.');
         }

         Discount::where('product_id', $product_id)
                ->where('id', '!=', $discount_id)
                ->update(['active' => 0, 'end_date' => now()]);

         $discount->active = 1;
         $discount->end_date = null;
         $discount->save();

        return redirect()->route('admin.discount')->with('success','Activated successfully');

        }catch (\Exception $e) {
            return back()->with('error', 'Failed to active. ' . $e->getMessage())->withInput();
        }
    }

    public function inactive($discount, $product){
        try {

            $discount_id = $discount;
            $product_id = $product;

            $discount = Discount::find($discount_id);
            if (!$discount) {
                return back()->with('error', 'Discount not found.');
            }

            $discount->active = 0;
            $discount->end_date = Carbon::now();
            $discount->save();

            return redirect()->route('admin.discount')->with('success','Deactivated successfully');

        }catch (\Exception $e) {
            return back()->with('error', 'Failed to inactive. ' . $e->getMessage())->withInput();
        }

    }
}

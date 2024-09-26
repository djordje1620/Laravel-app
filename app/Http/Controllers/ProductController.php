<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Discount;
use App\Models\InternalMemory;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductInternalMemory;
use App\Models\ProductRamMemory;
use App\Models\RamMemory;
use App\Models\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class ProductController extends Controller
{
    public function products(){
        $brands = Brand::all();
        $screens = Screen::all();
        $products = Product::with('brand', 'screen', 'prices', 'colors', 'internals', 'rams')->paginate(6);

        return view('pages.products.index',['brands'=>$brands, 'screens'=>$screens, 'products'=>$products]);
    }
    public function filterProducts(Request $request)
    {

        $product = new Product();
        $filteredProducts = $product->getFilteredProducts($request);

        if ($request->ajax()) {
            $paginationView = $filteredProducts->links('pagination::bootstrap-4')->render();
            return response()->json([
                'products' => $filteredProducts,
                'pagination' => $paginationView,
         ]);
        }


    }
    public function show($id){
        $product = Product::with('brand', 'screen', 'prices', 'colors', 'internals', 'rams')->where('id',$id)->first();
        return view('pages.products.show',["product"=>$product]);
    }

    public function adminShow(){
        $brands = Brand::all();
        $colors = Color::all();
        $rams = RamMemory::all();
        $internals = InternalMemory::all();
        $screens = Screen::all();
        $products = Product::with('brand', 'screen', 'prices', 'colors', 'internals', 'rams')->get();
        return view('pages.admin.admin-products',
            [
                'products'=>$products,
                'brands'=>$brands,
                'colors'=>$colors,
                'rams'=>$rams,
                'internals'=>$internals,
                'screens'=>$screens
            ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'brand' => 'required|exists:brands,id',
            'screens' => 'required|exists:screens,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'colors_product' => 'required|exists:colors,id',
            'ram_memory' => 'required|exists:ram_memories,id',
            'internal_memory' => 'required|exists:internal_memories,id',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();

        try {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            $product = new Product();
            $product->name = $request->product_name;
            $product->brand_id = $request->brand;
            $product->screen_id = $request->screens;
            $product->image = $imageName;
            $image->move(public_path('assets/images'), $imageName);
            $product->save();

            ProductColor::create([
                 'product_id' => $product->id,
                 'color_id' => $request->colors_product,
                 'start_date' => now(),
            ]);

            ProductRamMemory::create([
                'product_id' => $product->id,
                'ram_id' => $request->ram_memory,
                'start_date' => now(),
            ]);

            ProductInternalMemory::create([
                'product_id' => $product->id,
                'internal_id' => $request->internal_memory,
                'start_date' => now(),
            ]);

            Price::create([
                'product_id' => $product->id,
                'price' => $request->product_price,
            ]);

            DB::commit();


            return redirect()->route('admin.products')->with('success', 'Product added successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to add product. ' . $e->getMessage())->withInput();
        }
    }

    public function update($id){
        $product_id = $id;
        $brands = Brand::all();
        $colors = Color::all();
        $rams = RamMemory::all();
        $internals = InternalMemory::all();
        $screens = Screen::all();
            $products = Product::with('brand', 'screen', 'prices', 'colors', 'internals', 'rams')
                ->where('products.id','=', $product_id)
                ->get();

        return view('pages.admin.admin-products',
            [
                'products'=>$products,
                'brands'=>$brands,
                'colors'=>$colors,
                'rams'=>$rams,
                'internals'=>$internals,
                'screens'=>$screens
            ]);
    }

    public function store(Request $request){

        try {
            $validatedData = $request->validate([
                'new_product_name' => 'required|string|max:255',
                'new_brand' => 'required|exists:brands,id',
                'new_screens' => 'required|exists:screens,id',
                'new_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                'new_colors' => 'required|exists:colors,id',
                'new_ram' => 'required|exists:ram_memories,id',
                'new_internal_memory' => 'required|exists:internal_memories,id',
                'new_price' => 'required|numeric|min:0',
            ]);

            $product = Product::find($request->input('product_id'));

            if(!$product) {
                return back()->with('error', 'Product not found.');
            }

            $product->name = $validatedData['new_product_name'];
            $product->brand_id = $validatedData['new_brand'];
            $product->screen_id = $validatedData['new_screens'];

            if ($request->hasFile('new_image')) {
                $image = $request->file('new_image');
                $imageName = $image->getClientOriginalName();
                $product->image = $imageName;
                $image->move(public_path('assets/images'), $imageName);
            }

            $product->save();

            $product->colors()->sync([$validatedData['new_colors']]);
            $product->rams()->sync([$validatedData['new_ram']]);
            $product->internals()->sync([$validatedData['new_internal_memory']]);

            Price::where('product_id', $product->id)->update(['active' => 0]);

            $price = new Price();
            $price->product_id = $product->id;
            $price->price = $request->input('new_price');
            $price->active = 1;
            $price->save();

            return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update product. ' . $e->getMessage())->withInput();
        }
    }

    public function remove(Request $request){
        try {
            $id = $request->input('id');
            $product = Product::find($id);

            if (!$product) {
                return back()->with('error', 'Product not found.');
            }

            $product->brand()->dissociate();
            $product->screen()->dissociate();
            $product->colors()->detach();
            $product->rams()->detach();
            $product->internals()->detach();
            $product->prices()->delete();

            if (File::exists(public_path('/assets/images/' . $product->image))) {
                File::delete(public_path('/assets/images/' . $product->image));
            }

            $product->delete();

            return redirect()->route('admin.products')->with('success', 'Product removed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to remove product. ' . $e->getMessage());
        }
    }
}

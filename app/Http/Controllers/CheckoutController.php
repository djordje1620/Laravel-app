<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use App\Models\UserAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if ($request->ajax()) {
            $userId = auth()->id();
            $cartItems = $request->input('cartItems');

            try {
                DB::beginTransaction();

                $basket = new Basket();
                $basket->user_id = $userId;
                $basket->datum = now();
                $basket->status = 1;
                $basket->save();

                $basket->refresh();

                $userAction = new UserAction();
                $userAction->user_id = $userId;
                $userAction->action = "purchase";
                $userAction->action_time = Carbon::now();
                $userAction->ip_address = request()->ip();
                $userAction->device_type = $userAction->getDeviceType(request()->header('User-Agent'));
                $userAction->browser = $userAction->getBrowser(request()->header('User-Agent'));
                $userAction->save();

                foreach ($cartItems as $item) {
                    $product = Product::find($item['productId']);

                    if ($product) {
                        $latestPrice = $product->prices()->latest()->first();

                        if ($latestPrice) {
                            $basketProduct = new BasketProduct();
                            $basketProduct->basket_id = $basket->id;
                            $basketProduct->product_id = $product->id;
                            $basketProduct->price_id = $latestPrice->id;
                            $basketProduct->quantity = $item['quantity'];
                            $basketProduct->save();
                        }
                    }
                }

                DB::commit();

                $message = "Checkout successful!";
            } catch (\Exception $e) {
                DB::rollback();
                $message = "Checkout failed" .$e->getMessage();
            }

            return response()->json([
                'message' => $message,
            ]);
        }
    }
}

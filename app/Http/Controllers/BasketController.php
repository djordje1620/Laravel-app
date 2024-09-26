<?php

namespace App\Http\Controllers;

use App\Models\BasketProduct;
use App\Models\User;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index()
    {
        $id_user = '';
        $sortType = '';
        $users = $this->getUsers();
        $baskets = $this->getBaskets();

        return view('pages.admin.admin-basket', compact('baskets', 'sortType', 'users','id_user'));
    }

    public function sort(Request $request)
    {
        $id_user = '';
        $sortType = $request->input('sort');
        $users = $this->getUsers();
        $baskets = $this->getSortedBaskets($sortType);

        return view('pages.admin.admin-basket', compact('baskets', 'sortType', 'users','id_user'));
    }

    public function filter(Request $request)
    {
        $id_user = $request->input('name_user');
        $sortType = $request->input('sort', '');
        $users = $this->getUsers();
        $baskets = $this->getFilteredBaskets($id_user);

        return view('pages.admin.admin-basket', compact('baskets', 'sortType', 'users', 'id_user'));
    }

    private function getUsers()
    {
        return User::with('role')
            ->join('roles as r', 'users.role_id', '=', 'r.id')
            ->where('r.role', '=', 'korisnik')
            ->select("users.*", "r.role")
            ->get();
    }

    private function getBaskets()
    {
        return BasketProduct::with('basket', 'product', 'price', 'basket.user', 'product.discounts')->get();
    }

    private function getSortedBaskets($sortType)
    {
        return BasketProduct::with('basket.user', 'product.discounts', 'basket', 'product', 'price')
            ->join('baskets as b', 'basket_products.basket_id', '=', 'b.id')
            ->orderBy('b.datum', $sortType)
            ->get();
    }

    private function getFilteredBaskets($id_user)
    {
        return BasketProduct::with('basket.user', 'product.discounts', 'basket', 'product', 'price')
            ->join('baskets as b', 'basket_products.basket_id', '=', 'b.id')
            ->join('users as u', 'b.user_id', '=', 'u.id')
            ->where('u.id', '=', $id_user)
            ->get();
    }
}

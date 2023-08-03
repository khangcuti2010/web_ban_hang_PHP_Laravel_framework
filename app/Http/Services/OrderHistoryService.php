<?php


namespace App\Http\Services;


use App\Models\Cart;
use App\Models\Carts_Detail;
use Illuminate\Support\Facades\Auth;

class OrderHistoryService
{
    public function getCart()
    {
        $user_id = Auth::id();
        return Cart::where('user_id',$user_id)->orderbyDesc('created_at')->get();
    }

    public function getOrderDetail()
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id',$user_id)->orderbyDesc('created_at')->first();
        if($cart) {
            $cart_id = $cart->id;
            return Carts_Detail::where('cart_id', $cart_id)->get();
        } else{
            return null;
        }
    }
}

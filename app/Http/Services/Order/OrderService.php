<?php


namespace App\Http\Services\Order;


use App\Models\Cart;
use App\Models\Carts_Detail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class OrderService
{
    public function getAllOrder()
    {
        return Cart::orderbyDesc('created_at')->paginate(10)->onEachSide(2);
    }

    public function update($id, $request)
    {
        try {
            $id->status = (string)$request->input('status');
            $id->save();
            Session::flash('success', 'Cập nhật trạng thái đơn hàng thành công');
        }catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getOrderDetail($id)
    {
        return Carts_Detail::where('cart_id', $id)->orderbyDesc('created_at')->get();
    }

    public function getOrder($id)
    {
        return Cart::where('id',$id)->get();
    }

}

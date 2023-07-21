<?php


namespace App\Http\Services;
use App\Models\Cart;
use App\Models\Carts_Detail;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $quantity = $request->input('quantity');
        $product_id = $request->input('product_id');
        if($quantity <= 0 || $product_id <= 0)
        {
            Session::flash('error','Số lượng phải lớn hơn 0');
            return false;
        }
        $carts = Session::get('carts');
        if(is_null($carts))
        {
            Session::put('carts',[
                $product_id => $quantity
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $product_id);
        if($exists)
        {
            $carts[$product_id] = $carts[$product_id] + $quantity;
            Session::put('carts', $carts);
            return true;
        }
        $carts[$product_id] = $quantity;
        Session::put('carts', $carts);
        return true;

    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if(is_null($carts))
            return [];
        $productId = array_keys($carts);
        return Product::select('id','name','picture','price','price_sale')
            ->whereIn('id',$productId)
            ->where('active', 1)
            ->get();
    }

    public function update($request)
    {

        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id)
    {
        //xoá phần tử có $id
        $carts = Session::get('carts');
        unset($carts[$id]);
        //cập nhật lại Session
        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        try {
            $shopCart = Session::get('carts');
            if(is_null($shopCart)){
                return false;
            }else{
            //thêm vào bảng carts
                $user_id = (integer)Auth::id();
            $cart = Cart::create([
                'name' => (string)$request->input('name'),
                'email' => (string)$request->input('email'),
                'phone' => (string)$request->input('telephone'),
                'address' => (string)$request->input('address'),
                'content' => (string)$request->input('comments'),
                'user_id' => $user_id,
                'total_price' => (string)$request->input('total_price')
            ]);
            //lấy thông tin danh sách sản phẩm trong giỏ hàng
            $productId = array_keys($shopCart);
            $products = Product::select('id','name','picture','price','price_sale')
                ->whereIn('id',$productId)
                ->where('active', 1)
                ->get();
            //vòng lặp thêm mỗi sản phẩm trong giỏ hàng
            foreach ($products as $key => $product)
            {
                Carts_Detail::create([
                    'cart_id' => (int)$cart->id,
                    'product_id' => (int)$product->id,
                    'quantity' => (int)$shopCart[$product->id],
                    'price' => (int)$product->price_sale * $shopCart[$product->id]

                ]);
            }
            Session::pull('carts');
            return true;
            }
        }catch (\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
    }

}

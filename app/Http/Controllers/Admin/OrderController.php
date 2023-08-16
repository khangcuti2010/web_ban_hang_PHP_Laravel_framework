<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Requests\Product\ProductUpdateFormRequest;
use App\Http\Services\Order\OrderService;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderService $order)
    {
        $this->order = $order;
    }

    public function show()
    {
        return view('admin.order.list',[
            'title' => 'Danh Sách Đơn Hàng',
            'orders' => $this->order->getAllOrder(),
        ]);
    }

    public function edit()
    {
        return view('admin.order.edit',[
        'title' => 'Cập Nhật Đơn Hàng',
    ]);
    }

    public function update(Cart $id, Request $request)
    {
        $this->order->update($id,$request);
        return redirect('admin/order/list');
    }

    public function detail($id)
    {
        return view('admin.order.detail',[
            'title' => 'Chi Tiết Đơn Hàng ID: '.$id,
            'products' => $this->order->getOrderDetail($id),
            'orders' => $this->order->getOrder($id),
        ]);
    }
}

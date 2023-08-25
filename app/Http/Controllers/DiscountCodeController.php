<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscountCodeController extends Controller
{
    public function checkCodeDiscount(Request $request)
    {
        try{
            $code = $request->input('discount_code');
            $check = DiscountCode::where('code', $code)->firstorfail();
                $discount = Session::get('discount');
                Session::put('discount', [
                    'name' => $check->name,
                    'discount_amount' => $check->discount_percentage,
                ]);
                Session::flash('success', 'áp dụng mã giảm giá thành công');
                return redirect()->back()->with('success','áp dụng mã giảm giá thành công');
        }catch(\Exception $err) {
            return redirect()->back()->with('error', 'Mã giảm giá không hợp lệ');
        }

    }

    public function removeDiscount()
    {
        session()->forget('discount');
        return redirect()->back();
    }
}

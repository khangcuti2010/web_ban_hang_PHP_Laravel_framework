<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',['title' => 'ĐĂNG NHẬP HỆ THỐNG']);
    }

    public function store(Request $request)
    {
        // kiểm tra email và password đã điền chưa
        $request->validate([
            'email'=>'required|email:filter',
            'password'=>'required'
        ]);
        //kiẻm tra email với password có trùng với dữ liệu trong data không và kiểm tra ghi nhớ tài khoản
        if(Auth::attempt([
            'email'=>$request->input('email'),
            'password'=>$request->input('password')],
            $request->input('remember'))) {
            session()->flash('success','Đăng nhập thành công');
            return redirect()->route('main');// nếu thành công thì điều hướng tới route main
        }
        session()->flash('error','Email và password không đúng');
        // \Illuminate\Support\Facades\Session::flash('error','Email và password không đúng' );
        return redirect()->back();
    }
}


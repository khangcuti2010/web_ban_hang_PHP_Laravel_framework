<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;
use App\Http\Services\Slider\SliderService;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Verified;


class RegisterController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        return view('register',[
           'title' => 'Đăng Ký Tài Khoản'
        ]);
    }

    public function showVerification()
    {

        $successMessage = Session::get('success');

        return view('verify-email', [
            'title' => 'Xác Nhận Email',
            'successMessage' => $successMessage,
        ]);
    }

    /**
     * Handle the registration form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'email_verified_at' => null, // Xác nhận email chưa được xác minh
            'role' => 'user'
        ]);

        // Gửi email xác nhận
        event(new Registered($user));
        Session::flash('success', 'Một liên kết xác nhận đã được gửi đến địa chỉ email của bạn.');

        // Chuyển hướng người dùng sau khi đăng ký thành công
        return redirect('/verify-email')->with('verify','A email has been sent to your email');
    }




}

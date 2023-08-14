<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderbyDesc('created_at')->get();
        return view('admin.user.list',[
            'title' => 'Danh Sách Tài Khoản Người Dùng',
            'users' => $users,
        ]);
    }
}

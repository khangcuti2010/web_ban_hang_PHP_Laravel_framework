<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request,$id)
    {
        $comment = new Comment;
        $comment->product_id = $id;
        $comment->user_id = Auth::id();
        $comment->content = $request->input('comment');
        $comment->rating = $request->input('rate');
        $comment->save();
        Session::flash('success', 'Thêm đánh giá thành công');
        return redirect()->back();
    }
}

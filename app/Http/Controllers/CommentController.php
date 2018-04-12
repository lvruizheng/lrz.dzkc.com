<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('cookieis');
    }
    
    
    public function store(Request $request)
    {
        if($request->get('check_request')){
            return redirect()->back()->withInput()->withErrors($request->get('check_request'));
        }
        
        if (Comment::create($request->all())) {
            return redirect()->back();
        } else {
            return redirect()->back()->withInput()->withErrors('评论发表失败！');
        }
    }
}

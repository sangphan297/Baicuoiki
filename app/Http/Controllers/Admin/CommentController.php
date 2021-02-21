<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct(Comment $mcomment)
    {
    	$this->mcomment = $mcomment;
    }
    public function index()
    {
    	$comments = $this->mcomment->getAllComments();
    	return view('admin.comment.index',compact('comments'));
    }

    public function del($id)
    {
        $result = $this->mcomment->delComment($id);
        return redirect()->route('admin.comment.index')->with('msg', 'Deleted successfully.');
    }
}

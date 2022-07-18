<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Comment;

class CommentController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function comment_product(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', NULL)->where('comment_status', 1)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '!=', NULL)->orderBy('comment_id', 'DESC')->get();
        $output = "";

        foreach ($comment as $key => $com) {
            $output .= '
            <div class="review_item">
                <div class="media">                   
                    <div class="media-body">
                        <h3 style="color: #ed2a10">' . $com->comment_name . '</h3>
                        <h4>' . $com->comment_date . '</h4>
                    </div>
                </div>
                <p>
                    ' . $com->comment_content . '
                </p>
            </div>
            ';

            foreach ($comment_rep as $key => $comm_reply) {
                if ($comm_reply->comment_parent_comment == $com->comment_id) {
                    $output .= '<div class="review_item reply">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 style="color: blue">' . $comm_reply->comment_name . '</h3>
                                            <h4>' . $comm_reply->comment_date . '</h4>
                                        </div>
                                    </div>
                                    <p>
                                        ' . $comm_reply->comment_content . '
                                    </p>
                                </div>
                                ';
                }
            }
        }
        echo $output;
    }
    public function send_comment(Request $request)
    {

        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment_name = $comment_name;
        $comment->comment_content = $comment_content;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->save();
    }

    public function comment()
    {
        $this->AuthLogin();
        $comment = Comment::with('product')->where('comment_parent_comment', NULL)->orderBy('comment_id', 'desc')->paginate(10);
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '!=', NULL)->orderBy('comment_id', 'DESC')->get();
        return view('admin.comment')->with(compact('comment'))->with(compact('comment_rep'));
    }

    public function allow_comment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();

        $comment = new Comment();
        $comment->comment_content = $data['comment_content'];
        $comment->comment_name = 'Admin Aranoz Shop';
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;

        $comment->save();
    }
    public function delete_comment($comment_id)
    {
        $this->AuthLogin();
        DB::table('tbl_comment')->where('comment_id', $comment_id)->delete();
        return Redirect::to('comment');
    }
}

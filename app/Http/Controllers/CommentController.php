<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dogs_profile;
use App\Models\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function add($id){
        $user_id = Auth::id();
        $share = Share::find($id);
        $dog = Dogs_profile::where('user_id', $share['user_id'])->first();

        $comments = DB::table('comments')
            ->join('dogs_profiles', 'comments.user_id', '=', 'dogs_profiles.user_id')
            ->where('share_id', $id)
            ->select('comments.user_id', 'comments.comment', 'comments.created_at', 'dogs_profiles.dog_name', 'dogs_profiles.dog_gender')
            ->get();

        if ($comments === null){
            $comments = null;
        }

        return view('comment.index', compact('user_id','share', 'comments', 'dog'));
    }



    public function store(Request $request, $id){
        $comment = new Comment;
        $post = $request->post();

        $comment->user_id = Auth::id();
        $comment->share_id = $id;
        $comment->comment = $post['comment'];
        $comment->save();

        return back();
    }
}

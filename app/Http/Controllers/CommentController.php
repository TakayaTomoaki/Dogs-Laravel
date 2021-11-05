<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Dogs_profile;
use App\Models\Share;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function add($id){
        $user_id = Auth::id();

        $sql1 = <<<SQL
SELECT id, user_id, body, image, created_at,
    (SELECT COUNT(user_id) FROM nices WHERE share_id = $id) AS nice,
    (SELECT COUNT(user_id) FROM comments WHERE share_id = $id) AS comment,
    (SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = $id) AS count
FROM shares
WHERE id = $id
SQL;
        $shares = DB::select($sql1);


        $dog = Dogs_profile::where('user_id', $shares[0]->user_id)->first();

        $sql2 = <<<SQL
SELECT comments.id, comments.user_id, comment, comments.created_at, dog_name, dog_gender
FROM comments
LEFT JOIN dogs_profiles
ON comments.user_id = dogs_profiles.user_id
WHERE comments.share_id = $id
ORDER BY comments.created_at DESC
SQL;
        $comments = DB::SELECT($sql2);

        if ($comments === null){
            $comments = null;
        }

        return view('comment.index', compact('user_id','shares', 'comments', 'dog'));
    }





    public function store(Request $request, $id): RedirectResponse
    {
        $post = $request->post();
        if ($post['comment'] === null){
            return back();
        }

        $comment = new Comment;

        $comment->user_id = Auth::id();
        $comment->share_id = $id;
        $comment->comment = $post['comment'];
        $log = $comment->save();
        Log::debug($comment . 'commentの保存に成功しました。');

        if ($log === false) {
            Log::debug($comment . 'commentの保存に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
        }

        return back();
    }
}

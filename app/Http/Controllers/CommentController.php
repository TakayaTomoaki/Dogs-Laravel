<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostCommentRequest;
use App\Models\Comment;
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function add($id)
    {
        $user_id = Auth::id();

        $user = DB::table('dogs_profiles')
        ->select('dog_gender', 'dog_image')
        ->where('user_id', $user_id)
        ->first();

        $sql1 = <<<SQL
SELECT id, user_id, body, image, created_at,
    (SELECT COUNT(user_id) FROM nices WHERE share_id = $id) AS nice,
    (SELECT COUNT(user_id) FROM comments WHERE share_id = $id) AS comment,
    (SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = $id) AS count
FROM shares
WHERE id = $id AND deleted_at IS NULL
SQL;
        $shares = DB::select($sql1);
        if ($shares === []) {
            return redirect()->route('mypage', ['user_id' => $user_id]);
        }


        $dog = DB::table('dogs_profiles')
      ->select(
          "id",
          "user_id",
          "dog_name",
          "location",
          "dog_birthday",
          "dog_gender",
          "dog_weight",
          "dog_daddy",
          "dog_mommy",
          "dog_introduction",
          "dog_image"
      )
      ->where('user_id', $shares[0]->user_id)
      ->first();

        if ($dog === null) {
            return redirect()->route('create');
        }


        $sql2 = <<<SQL
        SELECT c.id,c.user_id,comment,c.created_at,dog_name,dog_gender,dog_image,
       (SELECT COUNT(*) FROM likes WHERE user_id = $user_id AND comment_id = c.id) AS count,
       (SELECT COUNT(user_id) FROM likes WHERE comment_id = c.id) AS likeCount
        FROM comments AS c
        INNER JOIN dogs_profiles AS d ON d.user_id = c.user_id
        WHERE share_id = $id AND deleted_at IS NULL
        ORDER BY created_at DESC
SQL;
        $comments = DB::SELECT($sql2);


        if ($comments === null) {
            $comments = null;
        }

        return view('comment.index', compact('user_id', 'shares', 'comments', 'dog', 'user'));
    }




    /**
     * @param PostCommentRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function store(PostCommentRequest $request, $id): RedirectResponse
    {
        $post = $request->validated();
        if ($post['comment'] === null) {
            return back();
        }

        $comment = new Comment;

        $comment->user_id = Auth::id();
        $comment->share_id = $id;
        $comment->comment = $post['comment'];
        $log = $comment->save();
        Log::debug($comment.'comment?????????????????????????????????');

        if ($log === false) {
            Log::debug($comment.'comment?????????????????????????????????');
            return back()->with('????????????????????????????????????????????????????????????????????????????????????');
        }

        return back();
    }





    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $post_id = $request->post('id');

        $log = Comment::find($post_id)->delete();
        Log::debug($user_id.$post_id.'comment?????????????????????????????????');

        if ($log === false) {
            Log::debug($user_id.$post_id.'comment?????????????????????????????????');
            return back()->with('??????????????????????????????????????????????????????????????????');
        }

        return back();
    }
}

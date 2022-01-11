<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LikeController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $post_id = $request->post('id');
        if ($post_id === null) {
            return back();
        }

        $like = new Like();
        $user_id = Auth::id();

        $like->user_id = $user_id;
        $like->comment_id = $post_id;

        $log = $like->save();
        Log::debug($like . 'likeの保存に成功しました。');

        if ($log === false) {
            Log::debug($like . 'likeの保存に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
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

        $sql = <<<SQL
DELETE
FROM likes
WHERE user_id = $user_id
AND comment_id = $post_id
SQL;

        $log = DB::DELETE($sql);
        Log::debug($user_id . $post_id . 'いいねの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id . $post_id . 'いいねの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }
        return back();
    }
}

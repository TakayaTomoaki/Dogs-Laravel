<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FollowController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $follow = new Follow;
        $user_id = Auth::id();
        $post_id = $request->post('id');

        $follow->follower = $user_id;
        $follow->receiver = $post_id;

        $log = $follow->save();
        Log::debug($follow . 'followの保存に成功しました。');

        if ($log === false) {
            Log::debug($follow . 'followの保存に失敗しました。');
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
FROM follows
WHERE follower = $user_id
AND receiver = $post_id
SQL;

        $log = DB::DELETE($sql);
        Log::debug($user_id . $post_id . 'unfollowの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id . $post_id . 'unfollowの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FollowController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $follow = new Follow;
        $user_id = Auth::id();
        $post = $request->post();

        $follow->follower = $user_id;
        $follow->receiver = $post['id'];

        $log = $follow->save();
        Log::debug($follow . 'followの保存に成功しました。');

        if ($log === false) {
            Log::debug($follow . 'followの保存に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
        }
        return back();

    }


    public function delete(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $post = $request->post();

        $sql = <<<SQL
DELETE 
FROM follows
WHERE follower = $user_id
AND receiver = $post[id]
SQL;

        $log = DB::DELETE($sql);
        Log::debug($user_id . $post['id'] . 'unfollowの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id . $post['id'] . 'unfollowの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }
        return back();

    }

}

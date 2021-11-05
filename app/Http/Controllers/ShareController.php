<?php

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShareController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $post = $request->post();
        if ($post['body'] === null) {
            return back();
        }

        $user_id = Auth::id();
        $share = new Share;

        if (!empty($post['image'])) {
            $path = $post['image']->store('public/image');
            $share->image = basename($path);
        } else {
            $share->image = null;
        }

        $share->user_id = $user_id;
        $share->body = $post['body'];
        $log = $share->save();
        Log::debug($share . 'shareの保存に成功しました。');

        if ($log === false) {
            Log::debug($share . 'shareの保存に失敗しました。');
            return back()->with('通信エラー。もう一度、保存ボタンを押して下さい。');
        }

        return back();
    }


    public function delete(Request $request)
    {
        $user_id = Auth::id();
        $post = $request->post();

        $sql = <<<SQL
DELETE 
FROM shares
WHERE id = $post[id]
SQL;
        $log = DB::DELETE($sql);
        Log::debug($user_id . $post['id'] . 'shareの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id . $post['id'] . 'shareの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }

        return redirect()->route('mypage', ['user_id' => $user_id]);
    }

}

<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostShareRequest;
use App\Models\Share;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShareController extends Controller
{
    /**
     * @param  PostShareRequest  $request
     * @return RedirectResponse
     */
    public function store(PostShareRequest $request): RedirectResponse
    {
        $post = $request->validated();
        $user_id = Auth::id();
        $share = new Share;

        //postから画像ファイルがあるかを判定
        if (!empty($post['image'])) {
            $path = $post['image']->store('public/image');
            $share->image = basename($path);
        } else {
            $share->image = null;
        }

        $share->user_id = $user_id;
        $share->body = $post['body'];
        $log = $share->save();
        Log::debug($share.'shareの保存に成功しました。');

        if ($log === false) {
            Log::debug($share.'shareの保存に失敗しました。');
            return back()->with('通信エラー。もう一度、保存ボタンを押して下さい。');
        }

        return back();
    }


    /**
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $post = $request->post();

        $sql = <<<SQL
DELETE
FROM shares
WHERE id = $post[id]
SQL;
        $log = DB::DELETE($sql);
        Log::debug($user_id.$post['id'].'shareの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id.$post['id'].'shareの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }

        return back();
    }
}

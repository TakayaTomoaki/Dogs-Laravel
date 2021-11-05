<?php

namespace App\Http\Controllers;

use App\Models\Nice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NiceController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $post = $request->post();
        if ($post['id'] === null) {
            return back();
        }

        $nice = new Nice();
        $user_id = Auth::id();

        $nice->user_id = $user_id;
        $nice->share_id = $post['id'];

        $log = $nice->save();
        Log::debug($nice . 'niceの保存に成功しました。');

        if ($log === false) {
            Log::debug($nice . 'niceの保存に失敗しました。');
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
FROM nices
WHERE user_id = $user_id
AND share_id = $post[id]
SQL;

        $log = DB::DELETE($sql);
        Log::debug($user_id . $post['id'] . 'いいねの削除に成功しました。');

        if ($log === false) {
            Log::debug($user_id . $post['id'] . 'いいねの削除に失敗しました。');
            return back()->with('通信エラー。もう一度、ボタンを押して下さい。');
        }
        return back();
    }





    public function index($id) {
        $user_id = Auth::id();

        $sql = <<<SQL
SELECT user_id,dog_name,dog_birthday,dog_gender,dog_weight,dog_daddy,dog_mommy,location,
              (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM dogs_profiles
WHERE user_id IN (SELECT user_id FROM nices WHERE share_id = $id)
SQL;
        $nices = DB::SELECT($sql);

        return view('mypage.nice', compact('user_id', 'nices'));


    }

}

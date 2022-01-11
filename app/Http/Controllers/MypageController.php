<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\DogProfileRequest;
use App\Models\Dogs_profile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MypageController extends Controller
{
    /**
     * @param $user_id
     * @return Application|Factory|View
     */
    public function add($user_id)
    {
        $user = Auth::id();
        //プロフィール情報の取得
        $sql = <<<SQL
SELECT dog_name,location,dog_birthday,dog_gender,dog_weight,dog_daddy,dog_mommy,dog_introduction,dog_image,
        (SELECT count(*) FROM follows WHERE receiver = $user_id AND follower = $user) AS follow,
        (SELECT count(*) FROM follows WHERE receiver = $user AND follower = $user_id) AS follower,
        (SELECT COUNT(follower) FROM follows WHERE follower = $user_id) AS countFollow,
        (SELECT COUNT(receiver) FROM follows WHERE receiver = $user_id) AS countReceive
FROM dogs_profiles
WHERE user_id = $user_id
SQL;

        $dog_prof = DB::SELECT($sql);

        //投稿一覧タブの取得
        $sql2 = <<<SQL
        SELECT s.id,s.user_id,body,image,s.created_at,dog_name,dog_gender,dog_image,
        (SELECT COUNT(user_id) FROM nices WHERE share_id = s.id) AS nice,
        (SELECT COUNT(user_id) FROM comments WHERE share_id = s.id) AS comment,
        (SELECT COUNT(*) FROM nices WHERE user_id = $user AND share_id = s.id) AS count
        FROM shares AS s
        INNER JOIN dogs_profiles AS d ON s.user_id = d.user_id
        WHERE s.user_id = $user_id AND deleted_at IS NULL
        ORDER BY created_at DESC
SQL;
        $shares = DB::select($sql2);

        if (empty($shares)) {
            $shares = null;
        }

        //いいね一覧タブの取得
        $sql3 = <<<SQL
        SELECT s.id,s.user_id,body,image,s.created_at,dog_name,dog_gender,dog_image,
        (SELECT COUNT(user_id) FROM nices WHERE share_id = s.id) AS nice,
        (SELECT COUNT(user_id) FROM comments WHERE share_id = s.id) AS comment,
        (SELECT COUNT(*) FROM nices WHERE user_id = $user AND share_id = s.id) AS count
        FROM shares AS s
        INNER JOIN dogs_profiles AS d ON s.user_id = d.user_id
        WHERE s.id IN (SELECT share_id FROM nices WHERE user_id = $user_id) AND deleted_at IS NULL
        ORDER BY created_at DESC
SQL;
        $nices = DB::select($sql3);

        //コメント一覧タブの取得
        $sql4 = <<<SQL
SELECT s.id,s.user_id,body,image,s.created_at,dog_name,dog_gender,dog_image,
        (SELECT COUNT(user_id) FROM nices WHERE share_id = s.id) AS nice,
        (SELECT COUNT(user_id) FROM comments WHERE share_id = s.id) AS comment,
        (SELECT COUNT(*) FROM nices WHERE user_id = $user AND share_id = s.id) AS count
FROM shares AS s
INNER JOIN dogs_profiles AS d ON s.user_id = d.user_id
WHERE s.id IN (SELECT share_id FROM comments WHERE user_id = $user_id) AND deleted_at IS NULL
ORDER BY created_at DESC
SQL;
        $comments = DB::select($sql4);

        if (! empty($dog_prof)) {
            return view(
                'mypage.index',
                compact('dog_prof', 'user_id', 'shares', 'nices', 'comments')
            );
        }
        return view('mypage.mypage', ['user_id' => $user]);
    }


    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $user_id = Auth::id();

        return view('mypage.create', compact('user_id'));
    }


    /**
     * @param DogProfileRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(DogProfileRequest $request)
    {
        $user_id = Auth::id();
        //プロフィール登録があるか判別
        $profile = (bool) DB::table('dogs_profiles')->where('user_id', $user_id)->first();
        if ($profile === true) {
            return redirect('home');
        }

        $post_data = $request->validated();
        $location = DB::table('users')->select('location')->where('id', $user_id)->first();

        $dog_prof = new Dogs_profile;

        //postから画像ファイルがあるかを判定
        if (! empty($post_data['dog_image'])) {
            //画像がある場合
            $path = $post_data['dog_image']->store('public/dog_image');
            $dog_prof->dog_image = basename($path);
        } else {
            //画像がない場合　nullを代入
            $dog_prof->dog_image = null;
        }

        $dog_prof->user_id = $user_id;
        $dog_prof->dog_name = $post_data['dog_name'];
        $dog_prof->location = config('prefecture.prefs')[$location->location];
        $dog_prof->dog_birthday = $post_data['dog_birthday'];
        $dog_prof->dog_gender = $post_data['dog_gender'];
        $dog_prof->dog_weight = $post_data['dog_weight'];
        $dog_prof->dog_father = $post_data['dog_father'];
        $dog_prof->dog_daddy = config('dogbreed.breeds') [$post_data['dog_father']];
        $dog_prof->dog_mother = $post_data['dog_mother'];
        $dog_prof->dog_mommy = config('dogbreed.breeds') [$post_data['dog_mother']];
        $dog_prof->dog_introduction = $post_data['dog_introduction'];

        $log = $dog_prof->save();
        Log::debug($dog_prof.'Dogs_profileの保存に成功しました。');

        if ($log === false) {
            Log::debug($dog_prof.'Dogs_profileの保存に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
        }

        return redirect()->route('mypage', ['user_id' => $user_id]);
    }


    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        $user_id = Auth::id();
        $dog_prof = DB::table('dogs_profiles')
      ->select(
          'dog_name',
          'user_id',
          'dog_birthday',
          'dog_gender',
          'dog_weight',
          'dog_father',
          'dog_mother',
          'location',
          'dog_image',
          'dog_introduction'
      )
      ->where('user_id', $user_id)
      ->first();

        return view(
            'mypage.profile',
            ['dog_prof' => $dog_prof, 'user_id' => $user_id,]
        );
    }


    /**
     * @param DogProfileRequest $request
     * @return RedirectResponse
     */
    public function update(DogProfileRequest $request): RedirectResponse
    {
        $user_id = Auth::id();
        $dog_prof = Dogs_profile::where('user_id', $user_id)->first();
        $post_data = $request->validated();

        if (! empty($dog_prof)) {
            //画像があるか判別
            if ($request->remove === 'true') {
                $dog_prof->dog_image = null;
            }
            if (! empty($post_data['dog_image'])) {
                $path = $post_data['dog_image']->store('public/dog_image');
                $dog_prof->dog_image = basename($path);
            }

            $dog_prof->dog_name = $post_data['dog_name'];
            $dog_prof->dog_birthday = $post_data['dog_birthday'];
            $dog_prof->dog_gender = $post_data['dog_gender'];
            $dog_prof->dog_weight = $post_data['dog_weight'];
            $dog_prof->dog_father = $post_data['dog_father'];
            $dog_prof->dog_daddy = config('dogbreed.breeds') [$post_data['dog_father']];
            $dog_prof->dog_mother = $post_data['dog_mother'];
            $dog_prof->dog_mommy = config('dogbreed.breeds') [$post_data['dog_father']];
            $dog_prof->dog_introduction = $post_data['dog_introduction'];

            $log = $dog_prof->save();
            Log::debug($dog_prof.'Dogs_profileの更新に成功しました。');

            if ($log === false) {
                Log::debug($dog_prof.'Dogs_profileの更新に失敗しました。');
                return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
            }
        }

        return redirect()->route('mypage', ['user_id' => $user_id]);
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function follow($id)
    {
        $user_id = Auth::id();

        $sql = <<<SQL
SELECT user_id, dog_name, dog_birthday, dog_gender, dog_weight, dog_daddy, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM dogs_profiles
WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $id)
SQL;
        $followers = DB::SELECT($sql);

        return view('mypage.follower', ['user_id' => $user_id, 'users' => $followers]);
    }


    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function receive($id)
    {
        $user_id = Auth::id();

        $sql = <<<SQL
SELECT user_id, dog_name, dog_birthday, dog_gender, dog_weight, dog_daddy, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM dogs_profiles
WHERE user_id IN (SELECT follower FROM follows WHERE receiver = $id)
SQL;
        $receivers = DB::SELECT($sql);

        return view('mypage.receiver', ['user_id' => $user_id, 'users' => $receivers]);
    }
}

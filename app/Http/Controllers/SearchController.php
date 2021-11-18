<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @param  Request  $request
     * @return Application|Factory|RedirectResponse|View
     */
    public function add(Request $request)
    {
        $user_id = Auth::id();
        $userLocation = DB::table('dogs_profiles')
      ->select('location')
      ->where('user_id', $user_id)
      ->first();

        if ($userLocation === null) {
            return redirect()->route('create');
        }

        //検索
        $search = $request->input('search');

        if ($search !== null) {
            $search_terms = mb_convert_kana($search, 's');

            $sql = <<< SQL
SELECT user_id, dog_name, dog_gender, dog_weight, dog_birthday, dog_father, dog_daddy, dog_mother, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM dogs_profiles
WHERE MATCH(dog_name, location, dog_daddy, dog_mommy, dog_introduction)
    AGAINST('$search_terms' IN BOOLEAN MODE)
SQL;

            $outputs = DB::SELECT($sql);
        }
        if ($search === null) {
            $outputs = null;
        }

        //おすすめユーザー：都道府県が同じプロフィール表示
        $sql2 = <<<SQL
SELECT user_id, dog_name, dog_birthday, dog_gender, dog_weight, dog_birthday, dog_daddy, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM dogs_profiles
WHERE location = '$userLocation->location'
SQL;

        $profiles = DB::SELECT($sql2);


        return view(
            'search.index',
            [
        'user_id' => $user_id,
        'profiles' => $profiles,
        'outputs' => $outputs,
      ]
        );
    }
}

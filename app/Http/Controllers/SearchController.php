<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dogs_profile;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function add(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        //検索
        $search = $request->input('search');

        if ($search !== null) {
            $search_terms = mb_convert_kana($search, 's');

//            $query = DB::table('dogs_profiles');
//            $query->whereRaw("match(`dog_name`, `location`, `dog_daddy`, `dog_mommy`, `dog_introduction`) against (? IN BOOLEAN MODE)", ['+' . $search_terms]);
//            $query->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_father', 'dog_daddy', 'dog_mother', 'dog_mommy', 'location', 'dog_image');
//            $outputs = $query->paginate(20);

$sql = <<< SQL
SELECT 
    user_id, dog_name, dog_gender, dog_weight, dog_birthday, dog_father, dog_daddy, dog_mother, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM 
    dogs_profiles
WHERE 
    MATCH(dog_name, location, dog_daddy, dog_mommy, dog_introduction) 
    AGAINST('$search_terms' IN BOOLEAN MODE)
SQL;

        $outputs = DB::SELECT($sql);

        }
        if ($search === null) {
            $outputs = null;
        }

        $location = config('prefecture.prefs') [$user['location']];

        //おすすめユーザー：都道府県が同じプロフィール表示

$sql2 = <<<SQL
SELECT
    user_id, dog_name, dog_birthday, dog_gender, dog_weight, dog_birthday, dog_daddy, dog_mommy, location, dog_image,
       (SELECT count(*) FROM follows WHERE receiver = user_id AND follower = $user_id) AS follow
FROM
    dogs_profiles
WHERE
    location = '$location'
SQL;

    $profiles = DB::SELECT($sql2);
//
//        $prof = DB::table('dogs_profiles')
//            ->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_daddy', 'dog_mommy', 'location', 'dog_image',
//              DB::raw('count(*) from follows where receiver = user_id and follower = $user_id as follow'))
//            ->where('location', '=', $location)
//            ->paginate(6);
//        ddd($prof);


        return view('search.index',
            [
                'user_id' => $user_id,
                'profiles' => $profiles,
                'user' => $user,
                'outputs' => $outputs,
            ]);
    }


}

<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dogs_profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function add(Request $request)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        //検索
        $search = $request->input('search');
        $query = DB::table('dogs_profiles');

        if ($search !== null) {
            $search_terms = mb_convert_kana($search, 's');
//            $search_split = preg_split("/[\s,]+/", $search_terms, -1, PREG_SPLIT_NO_EMPTY);
//            foreach ($search_split as $string) {
//                dd($search_split['0']);
//                $query->where('dog_name', 'like', '%' . $string . '%');
            $query->whereRaw("match(`dog_name`, `location`, `dog_daddy`, `dog_mommy`, `dog_introduction`) against (? IN BOOLEAN MODE)", ['+'.$search_terms]);
            $query->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_father', 'dog_daddy', 'dog_mother', 'dog_mommy', 'location', 'dog_image');
            $outputs = $query->paginate(20);
//            $outputs = $query->get();
//            dd($outputs);

        }
        if ($search === null) {
            $outputs = null;
        }


        //おすすめユーザー：都道府県が同じプロフィール表示
        $profiles = DB::table('dogs_profiles')
            ->where('location', '=', config('prefecture.prefs') [$user['location']])
            ->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_father', 'dog_daddy', 'dog_mother', 'dog_mommy', 'location', 'dog_image')
        ->paginate(20);

        if (!empty($profiles['items'])) {
            $profiles = null;
        }
//        dd($profiles);


        return view('search.index', ['user_id' => $user_id, 'profiles' => $profiles, 'user' => $user, 'outputs' => $outputs]);
    }
}

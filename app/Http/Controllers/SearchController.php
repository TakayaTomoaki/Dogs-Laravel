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
        $user = Auth::user()->location;

        $search = $request->input('search');
        //検索フォーム
        $query = DB::table('dogs_profiles')->join('users', 'user_id', '=', 'users.id');
        if ($search !== null) {
            $search_terms = mb_convert_kana($search, 's');
            $search_split = preg_split("/[\s,]+/", $search_terms, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($search_split as $string) {
                $query->where('dog_name', 'like', '%' . $string . '%');
            }
            $query->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_father', 'dog_mother', 'location', 'dog_image');
            $outputs = $query->paginate(20);
        }
        if ($search === null) {
            $outputs = null;
        }


        //おすすめユーザー：都道府県が同じプロフィール表示
        $profiles = DB::table('dogs_profiles')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('location', 'like', $user)
            ->select('user_id', 'dog_name', 'dog_gender', 'dog_weight', 'dog_birthday', 'dog_father', 'dog_mother', 'location', 'dog_image')
            ->paginate(20);
//            ->get();

//        dd($profiles);


        return view('search.index', ['user_id' => $user_id, 'profiles' => $profiles, 'user' => $user, 'outputs' => $outputs]);
    }
}

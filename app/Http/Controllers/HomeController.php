<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * @param
     * @return Application|Factory|RedirectResponse|View
     */
    public function add()
    {
        $user_id = Auth::id();

        $dog = DB::table('dogs_profiles')
          ->select('dog_image')->where('user_id', $user_id)->first();


        $sql = <<<SQL
SELECT id,user_id,body,image,created_at,
        (SELECT dog_name FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_name,
        (SELECT dog_gender FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_gender,
        (SELECT dog_image FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_image,
        (SELECT COUNT(user_id) FROM nices WHERE share_id = shares.id) AS nice,
        (SELECT COUNT(user_id) FROM comments WHERE share_id = shares.id) AS comment,
        (SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = shares.id) AS count
FROM shares
WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $user_id) OR user_id = $user_id
ORDER BY created_at DESC
LIMIT 20
SQL;
        $shares = DB::select($sql);
//        dd($shares);


        if (!empty($shares) && $shares[0]->dog_name === null) {
            return redirect()->route('create');
        }

        return view('home', compact('user_id', 'shares', 'dog'));
    }





    /**
     * @param
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $user_id = Auth::id();

        $sql = <<<SQL
SELECT COUNT(*) AS count
FROM shares
WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $user_id) OR user_id = $user_id
SQL;
        (int) $dbCount = DB::select($sql);
        (int) $postCount = $_POST['count'];

        if ($dbCount[0]->count === $postCount) {
            $shares = [];
            return response()->json($shares);
        }

        $sql2 = <<<SQL
SELECT id,user_id,body,image,created_at,
       (SELECT dog_name FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_name,
       (SELECT dog_gender FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_gender,
       (SELECT dog_image FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_image,
       (SELECT COUNT(user_id) FROM nices WHERE share_id = shares.id) AS nice,
       (SELECT COUNT(user_id) FROM comments WHERE share_id = shares.id) AS comment,
       (SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = shares.id) AS count
FROM shares
WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $user_id) OR user_id = $user_id
ORDER BY created_at DESC
LIMIT $postCount, 20
SQL;
        $shares = DB::select($sql2);

        return response()->json([$shares, $user_id]);
    }
}

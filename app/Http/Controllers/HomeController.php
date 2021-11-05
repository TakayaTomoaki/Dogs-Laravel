<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     */
    public function add(Request $request): Renderable
    {
        $user_id = Auth::id();

        $sql = <<<SQL
SELECT id,user_id,body,image,created_at,
        (SELECT dog_name FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_name,
        (SELECT dog_gender FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_gender,
        (SELECT COUNT(user_id) FROM nices WHERE share_id = shares.id) AS nice,
        (SELECT COUNT(user_id) FROM comments WHERE share_id = shares.id) AS comment,
        (SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = shares.id) AS count
FROM shares
WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $user_id)
ORDER BY created_at DESC
LIMIT 10
SQL;
        $shares = DB::select($sql);

        return view('home', compact('user_id', 'shares'));

    }







    public function index(Request $request)
    {
        $user_id = Auth::id();
        $count = $_POST['count'];

        $sql = <<<SQL
SELECT id,user_id,body,image,created_at,(SELECT dog_name FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_name,(SELECT dog_gender FROM dogs_profiles WHERE user_id = shares.user_id) AS dog_gender,(SELECT COUNT(user_id) FROM nices WHERE share_id = shares.id) AS nice,(SELECT COUNT(user_id) FROM comments WHERE share_id = shares.id) AS comment,(SELECT COUNT(*) FROM nices WHERE user_id = $user_id AND share_id = shares.id) AS count FROM shares WHERE user_id IN (SELECT receiver FROM follows WHERE follower = $user_id) ORDER BY created_at DESC LIMIT $count, 10
SQL;
        $shares = DB::select($sql);

        return response()->json($shares);

    }


}

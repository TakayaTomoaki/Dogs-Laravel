<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Share;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('home', ['user_id' => $user_id]);
    }

    public function store(Request $request): RedirectResponse
    {
        $post = $request->post();
        if ($post['body'] === null) {
            return back();
        }

        $user_id = Auth::id();
        $share = new Share();

        if (!empty($post['image'])) {
            $path = $post['image']->store('public/image');
            $share->image = basename($path);
        } else {
            $share->image = null;
        }

        $share->user_id = $user_id;
        $share->body = $post['body'];
        $share->save();

        return back();
    }

}

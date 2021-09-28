<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoticeController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function add(Request $request)
    {
        $user_id = Auth::id();
        return view('notice.index', ['user_id' => $user_id]);
    }
}

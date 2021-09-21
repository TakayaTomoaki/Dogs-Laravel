<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function add(Request $request)
    {
        $user_id = Auth::id();
        return view('messages.index', ['user_id' => $user_id]);
    }
}

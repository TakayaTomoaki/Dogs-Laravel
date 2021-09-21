<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetupController extends Controller
{
    public function add()
    {
        $user_id = Auth::id();

        return view('setup.index', ['user_id' => $user_id]);
    }

    public function edit()
    {
        $user_id = Auth::id();
        $user_data = User::find( $user_id);

        if (empty($user_data)) {
            abort(404);
        }

        return view('setup.user', ['user_form' => $user_data, 'user_id' => $user_id]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $user_data = User::find($user_id);
        $user_form = $request->post();

        $user_data->id = $user_id;
        $user_data->name = $user_form['name'];
        $user_data->location = $user_form['location'];
        $user_data->email = $user_form['email'];
        $user_data->password = $user_form['password'];

        $user_data->save();

        return redirect()->route('setup', ['user_id' => $user_id]);
    }

    public function handle()
    {
        $user_id = Auth::id();
        return view('setup.account', ['user_id' => $user_id]);
    }
}

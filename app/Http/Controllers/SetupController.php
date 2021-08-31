<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function add(Request $request)
    {
        $id = User::find($request->id);

        return view('setup.index', ['id' => $id]);
    }

    public function edit(Request $request)
    {
        $id = User::find($request->id);
        if (empty($id)) {
            abort(404);
        }

        return view('setup.user', ['user_form' => $id]);
    }

    public function update(Request $request)
    {
        $id = User::find($request->id);
        $user_form = $request->all();

        unset($user_form['_token']);
        $id->fill($user_form)->save();

        return redirect('setup');
    }

    public function handle()
    {
        return view('setup.account');
    }
}

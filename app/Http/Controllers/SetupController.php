<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dogs_profile;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class SetupController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function add()
    {
        $user_id = Auth::id();

        return view('setup.index', ['user_id' => $user_id]);
    }


    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        $user_id = Auth::id();
        $user_data = DB::table('users')->where('id', $user_id)->first();

        if (empty($user_data)) {
            abort(404);
        }

        return view('setup.user', ['user_form' => $user_data, 'user_id' => $user_id]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $user_data = User::find($user_id);
        $user_form = $request->post();
        $local_name = config('prefecture.prefs') [$user_form['location']];

        $user_data->id = $user_id;
        $user_data->name = $user_form['name'];
        $user_data->location = $user_form['location'];
        $user_data->email = $user_form['email'];
        $user_data->password = Hash::make($user_form['password']);

        $log = $user_data->save();
        Log::debug($user_data.'user_dataの更新に成功しました。');

        if ($log === false) {
            Log::debug($user_data.'user_dataの更新に失敗しました。');
        }


        $dog = Dogs_profile::where('user_id', $user_id)->first();

        if ($dog->location !== $local_name) {
            $dog->location = $local_name;
            $log = $dog->save();
            Log::debug($user_data.'local_nameの更新に成功しました。');

            if ($log === false) {
                Log::debug($user_data.'local_nameの更新に失敗しました。');
            }
        }

        return redirect()->route('setup', ['user_id' => $user_id]);
    }


    /**
     * @return Application|Factory|View
     */
    public function handle()
    {
        $user_id = Auth::id();
        return view('setup.logout', ['user_id' => $user_id]);
    }
}

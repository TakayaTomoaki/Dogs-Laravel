<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dogs_profile;
use App\Models\Share;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class MypageController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function add($user_id)
    {
        $user = Auth::id();
        $dog_prof = Dogs_profile::where('user_id', $user_id)->first();

        //年齢の計算：App/helpers.php
        $dog_age = age($user_id);
        //性別の判定：App/helpers.php
        $dog_gender = gender($user_id);

        $shares = Share::where('user_id', $user_id)->get();
        if (empty($shares)) {
            $shares = null;
        }

        if (!empty($dog_prof)) {
            return view('mypage.index', compact('dog_prof', 'user_id', 'dog_age', 'dog_gender', 'shares'));
        }
        return view('mypage.mypage', ['user_id' => $user]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $user_id = Auth::id();

        return view('mypage.create', compact('user_id'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, Dogs_profile::$rules);
        $user_id = Auth::id();
        $user = User::find($user_id);
        $dog_prof = new Dogs_profile();
        $post_data = $request->post();

        //postから画像ファイルがあるかを判定
        if (!empty($post_data['dog_image'])) {
            //画像がある場合
            $path = $post_data['dog_image']->store('public/dog_image');
            $dog_prof->dog_image = basename($path);
        } else {
            //画像がない場合　nullを代入
            $dog_prof->dog_image = null;
        }

        $dog_prof->user_id = $user_id;
        $dog_prof->dog_name = $post_data['dog_name'];
        $dog_prof->location = config('prefecture.prefs') [$user['location']];
        $dog_prof->dog_birthday = $post_data['dog_birthday'];
        $dog_prof->dog_gender = $post_data['dog_gender'];
        $dog_prof->dog_weight = $post_data['dog_weight'];
        $dog_prof->dog_father = $post_data['dog_father'];
        $dog_prof->dog_daddy = config('dogbreed.breeds') [$post_data['dog_father']];
        $dog_prof->dog_mother = $post_data['dog_mother'];
        $dog_prof->dog_mommy = config('dogbreed.breeds') [$post_data['dog_mother']];
        $dog_prof->dog_introduction = $post_data['dog_introduction'];

        $log = $dog_prof->save();
        Log::debug($dog_prof . 'Dogs_profileの保存に成功しました。');

        if ($log === false) {
            Log::debug($dog_prof . 'Dogs_profileの保存に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
        }

        return redirect()->route('mypage', ['user_id' => $user_id]);
    }

    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        $user_id = Auth::id();
        $dog_prof = Dogs_profile::where('user_id', $user_id)->first();

        if (!empty($dog_prof)) {
            $dog_gender = $dog_prof->dog_gender;
        }

        return view('mypage.profile', ['dog_prof' => $dog_prof, 'user_id' => $user_id, 'dog_gender' => $dog_gender]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request): RedirectResponse
    {
        $this->validate($request, Dogs_profile::$rules);
        $user_id = Auth::id();
        $dog_prof = Dogs_profile::where('user_id', $user_id)->first();
        $post_data = $request->post();

        if (!empty($dog_prof)) {
            //画像があるか判別
            if ($request->remove === 'true') {
                $dog_prof->dog_image = null;
            }
            if (!empty($post_data['dog_image'])) {
                $path = $post_data['dog_image']->store('public/dog_image');
                $dog_prof->dog_image = basename($path);
            }

            $dog_prof->dog_name = $post_data['dog_name'];
            $dog_prof->dog_birthday = $post_data['dog_birthday'];
            $dog_prof->dog_gender = $post_data['dog_gender'];
            $dog_prof->dog_weight = $post_data['dog_weight'];
            $dog_prof->dog_father = $post_data['dog_father'];
            $dog_prof->dog_daddy = config('dogbreed.breeds') [$post_data['dog_father']];
            $dog_prof->dog_mother = $post_data['dog_mother'];
            $dog_prof->dog_mommy = config('dogbreed.breeds') [$post_data['dog_father']];
            $dog_prof->dog_introduction = $post_data['dog_introduction'];

            $log = $dog_prof->save();
            Log::debug($dog_prof . 'Dogs_profileの更新に成功しました。');

            if ($log === false) {
                Log::debug($dog_prof . 'Dogs_profileの更新に失敗しました。');
                return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
            }
        }

        return redirect()->route('mypage', ['user_id' => $user_id]);
    }

    public function delete(Request $request)
    {
        $dog_prof = Dogs_profile::find($request->id);
        // $dog_image = $dog_prof()->dog_image;
        // Dogs_profile::delete('delete users where name = ?', ['John'])
        $dog_prof->delete();
        return redirect('mypage/profile');
    }
}

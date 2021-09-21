<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dogs_profile;
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
    public function add()
    {
        $user_id = Auth::id();
        $dates = Dogs_profile::where('user_id', $user_id)->get();
        foreach ($dates as $data) {
            $prof_data = $data;
        }

        if (!empty($prof_data)) {
            //年齢の計算
            $now = date("Ymd");
            $birthday = str_replace("-", "", $prof_data->dog_birthday);
            $dog_age = floor(($now - $birthday) / 10000);
            //性別の判定
            if ($prof_data->dog_gender === 0) {
                $dog_gender = 'オス';
            }
            if ($prof_data->dog_gender === 1) {
                $dog_gender = 'メス';
            }
            return view('mypage.index', ['prof_data' => $prof_data, 'user_id' => $user_id, 'dog_age' => $dog_age, 'dog_gender' => $dog_gender]);
        }
        return view('mypage.mypage', compact('user_id'));
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
        $dog_prof = new Dogs_profile();
        $prof_dates = $request->post();

        //postから画像ファイルがあるかを判定
        if (! empty($prof_dates['dog_image'])) {
            //画像がある場合
            $path = $prof_dates['dog_image']->store('public/dog_image');
            $dog_prof->dog_image = basename($path);
        } else {
            //画像がない場合　nullを代入
            $dog_prof->dog_image = null;
        }

        $dog_prof->user_id = $user_id;
        $dog_prof->dog_name = $prof_dates['dog_name'];
        $dog_prof->dog_birthday = $prof_dates['dog_birthday'];
        $dog_prof->dog_gender = $prof_dates['dog_gender'];
        $dog_prof->dog_weight = $prof_dates['dog_weight'];
        $dog_prof->dog_father = $prof_dates['dog_father'];
        $dog_prof->dog_mother = $prof_dates['dog_mother'];
        $dog_prof->dog_introduction = $prof_dates['dog_introduction'];

        $log = $dog_prof->save();
        Log::debug($dog_prof.'Dogs_profileの保存に成功しました。');

        if($log === false) {
            Log::debug($dog_prof.'Dogs_profileの保存に失敗しました。');
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
        $dates = Dogs_profile::where('user_id', $user_id)->get();
        foreach ($dates as $data) {
            $prof_data = $data;
        }
        if (! empty($prof_data)) {
            $dog_gender = $prof_data->dog_gender;
        }

        return view('mypage.profile', ['prof_data' => $prof_data, 'user_id' => $user_id, 'dog_gender' => $dog_gender]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user_id = Auth::id();
        $dates= Dogs_profile::where('user_id', $user_id)->get();
        foreach ($dates as $data) {
            $dog_prof = $data;
        }
        $prof_dates = $request->post();

        //postから画像があるか判別
        if ($request->remove === 'true') {
            $dog_prof->dog_image = null;
        }
        if (!empty($prof_dates['dog_image'])) {
            $path = $prof_dates['dog_image']->store('public/dog_image');
            $dog_prof->dog_image = basename($path);
        }

        $dog_prof->dog_name = $prof_dates['dog_name'];
        $dog_prof->dog_birthday = $prof_dates['dog_birthday'];
        $dog_prof->dog_gender = $prof_dates['dog_gender'];
        $dog_prof->dog_weight = $prof_dates['dog_weight'];
        $dog_prof->dog_father = $prof_dates['dog_father'];
        $dog_prof->dog_mother = $prof_dates['dog_mother'];
        $dog_prof->dog_introduction = $prof_dates['dog_introduction'];

        $log = $dog_prof->save();
        Log::debug($dog_prof.'Dogs_profileの更新に成功しました。');

        if($log === false) {
            Log::debug($dog_prof.'Dogs_profileの更新に失敗しました。');
            return back()->with('保存に失敗しました。もう一度、保存ボタンを押して下さい。');
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

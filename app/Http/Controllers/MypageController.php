<?php

namespace App\Http\Controllers;

use App\Dogs_profile;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function add(Request $request)
    {
        $is_dog = Dogs_profile::find($request->id);

        if (empty($is_dog)) {
            return view('mypage.mypage');
        } else {
            return view('mypage.index', ['is_dog' => $is_dog]);
        }
    }

    public function edit(Request $request)
    {
        $is_dog = Dogs_profile::find($request->id);

        if (empty($is_dog)) {
            return redirect('mypage/profile/create');
        } else {
            return view('mypage.profile', ['is_dog' => $is_dog]);
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, Dogs_profile::$rules);
        $is_dog = new Dogs_profile();
        $dog_prof = $request->all();

        if (isset($dog_prof['dog_image'])) {
            $path = $request->file('dog_image')->store('public/dog_image');
            $is_dog->dog_image = basename($path);
        } else {
            $is_dog->dog_image = null;
        }

        unset($dog_prof['_token']);
        unset($dog_prof['dog_image']);
        $is_dog->fill($dog_prof)->save();
        return redirect('mypage');
    }

    public function update(Request $request)
    {
        $is_dog = Dogs_profile::find($request->id);
        $dog_form = $request->all();
        if ($request->remove == 'true') {
            $dog_form['dog_image'] = null;
        } elseif ($request->file('dog_image')) {
            $path = $request->file('dog_image')->store('public/dog_image');
        } else {
            $dog_form['dog_image'] = $is_dog->dog_image;
        }
        unset($dog_form['_token']);
        unset($dog_form['dog_image']);
        unset($dog_form['remove']);
        $is_dog->fill($dog_form)->save();

        return redirect('mypage');
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

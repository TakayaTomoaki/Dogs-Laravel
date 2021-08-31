<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function add(Request $request)
    {
        $id = User::find($request->id);
        return view('search.index', ['id' => $id]);
    }
}

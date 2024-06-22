<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * ユーザーをフォローするアクション。
     *
     * @param  $id  相手ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function store(string $id) {
        \Auth::user()->follow(intval($id));
        return back();
    }

    /**
     * ユーザーをアンフォローするアクション。
     *
     * @param  $id  相手ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id) {
        \Auth::user()->unfollow(intval($id));
        return back();
    }
}

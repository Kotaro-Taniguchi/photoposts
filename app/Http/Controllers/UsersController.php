<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', ['users' => $users]);
    }

    public function show(string $id) {
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }

    /**
     * ユーザーのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id) {
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        $followings = $user->followings()->paginate(10);

        return view('users.followings', ['user' => $user, 'users' => $followings]);
    }

    /**
     * ユーザーのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id) {
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        $followers = $user->followers()->paginate(10);

        return view('users.followers', ['user' => $user, 'users' => $followers]);
    }

    public function favorites($id) {
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        $posts = $user->favorites()->paginate(10);

        return view('users.favorites', ['user' => $user, 'posts' => $posts]);
    }
}

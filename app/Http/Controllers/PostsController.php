<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\PostCreateValidation;

class PostsController extends Controller
{
    public function index() {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの投稿を作成日時の降順で取得
            $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }

        return view('dashboard', $data);
    }

    public function create() {
        $post = new Post();
        return view('posts.create', ['post' => $post]);
    }

    public function store(PostCreateValidation $request) {
        $newPost = \Auth::user()->posts()->create(['post' => $request->input('post')]);

        if ($request->input('image_file') != null) {  // 画像の投稿があれば
            // base64をデコードする準備
            $image_file = $request->input('image_file');
            $image_file = str_replace('data:image/jpeg;base64,', '', $image_file);
            $image_file = str_replace(' ', '+', $image_file);

            // デコード
            $image_file = base64_decode($image_file);

            // ストレージに保存し、パスを取得
            $file_name = Str::uuid()->toString();
            \File::put(storage_path() . '/app/public/images/' . $file_name . '.jpeg', $image_file);
            $image_path = 'public/images/' . $file_name . '.jpeg';
            // 画像のパスを保存
            $newPost->image()->create(['image_path' => $image_path]);
        }

        return back();
    }
}

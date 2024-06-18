@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>会員登録</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="w-1/2">
            @csrf

            <div class="form-control my-4">
                <label for="name" class="label">
                    <span class="label-text">名前</span>
                </label>
                <input type="text" name="name" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="email" class="label">
                    <span class="label-text">メールアドレス</span>
                </label>
                <input type="email" name="email" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password" class="label">
                    <span class="label-text">パスワード</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="password_confirmation" class="label">
                    <span class="label-text">パスワードの確認</span>
                </label>
                <input type="password" name="password_confirmation" class="input input-bordered w-full">
            </div>

            <div class="form-control my-4">
                <label for="profile_image" class="label">
                    <span class="label-text">プロフィール画像</span>
                </label>
                <input type="file" name="profile_image" value="" accept="image/png, image/jpeg">
            </div>

            <button type="submit" class="btn bg-blue-300 hover:bg-blue-400 btn-block normal-case">会員登録</button>
        </form>
    </div>
@endsection

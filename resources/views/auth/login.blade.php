@extends('layouts.app')

@section('content')

    <div class="prose mx-auto text-center">
        <h2>ログイン</h2>
    </div>

    <div class="flex justify-center">
        <form method="POST" action="{{ route('login') }}" class="w-1/2">
            @csrf

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

            <button type="submit" class="btn bg-blue-300 hover:bg-blue-400 btn-block normal-case">ログイン</button>

            {{-- 会員登録ページへのリンク --}}
            <p class="mt-2">新規ユーザーですか？ <a class="link link-hover text-info" href="{{ route('register') }}">会員登録はこちら！</a></p>
        </form>
    </div>
@endsection

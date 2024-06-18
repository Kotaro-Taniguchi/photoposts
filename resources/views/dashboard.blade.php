@extends('layouts.app')

@section('content')
    <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
        <div class="hero-content text-center my-10">
            <div class="max-w-md mb-10">
                <h2 class="tracking-wide">Welcome to the PhotoPosts</h2>
                <a class="btn bg-blue-300 hover:bg-blue-400 btn-lg normal-case" href="{{ route('register') }}">会員登録はこちら！</a>
            </div>
        </div>
    </div>
@endsection

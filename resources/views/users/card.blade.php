<div class="card border border-base-300">
    <div class="card-body bg-base-200 text-4xl">
        <h2 class="card-title">{{ $user->name }}</h2>
    </div>
    <figure>
        @if ($user->profile_image_path == null)
            <img src="{{ asset('default.png') }}" alt="プロフィール画像" width="500" height="500" />
        @else
            <img src="{{ Storage::url($user->profile_image_path) }}" alt="プロフィール画像" width="500" height="500" />
        @endif
    </figure>
</div>
@if (Auth::user()->id == $user->id)
    <a class="btn bg-blue-300 hover:bg-blue-400 normal-case w-full" href="{{ route('posts.create') }}">新規ポストの投稿</a>
@endif

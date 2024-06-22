<div class="tabs tabs-lifted">
    {{-- ユーザー詳細タブ --}}
    <a href="{{ route('users.show', $user->id) }}" class="tab grow {{ Request::routeIs('users.show') ? 'tab-active' : '' }}">
        タイムライン
        <div class="badge badge-neutral ml-1">{{ $user->posts_count }}</div>
    </a>
    {{-- フォロー一覧タブ --}}
    <a href="{{ route('users.followings', $user->id) }}" class="tab grow {{ Request::routeIs('users.followings') ? 'tab-active' : '' }}">
        フォロー中
        <div class="badge badge-neutral ml-1">{{ $user->followings_count }}</div>
    </a>
    {{-- フォロワー一覧タブ --}}
    <a href="{{ route('users.followers', $user->id) }}" class="tab grow {{ Request::routeIs('users.followers') ? 'tab-active' : '' }}">
        フォロワー
        <div class="badge badge-neutral ml-1">{{ $user->followers_count }}</div>
    </a>
    {{-- お気に入り投稿一覧タブ --}}
    <a href="{{ route('users.favorites', $user->id) }}" class="tab grow {{ Request::routeIs('users.favorites') ? 'tab-active' : '' }}">
        いいね！
        <div class="badge badge-neutral ml-1">{{ $user->favorites_count }}</div>
    </a>
</div>

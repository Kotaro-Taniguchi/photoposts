@if (Auth::check())
    {{-- ユーザー一覧へのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.index') }}">ユーザー一覧</a></li>
    {{-- ユーザー詳細へのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}のプロフィール</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログアウトへのリンク --}}
    <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">ログアウト</a></li>
@else
    <li><a class="link link-hover" href="{{ route('register')}}">会員登録</a></li>
    <li class="divider lg:hidden"></li>
    <li><a class="link link-hover" href="{{ route('login') }}">ログイン</a></li>
@endif

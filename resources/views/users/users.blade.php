@if (isset($users))
    <ul class="list-none">
        @foreach($users as $user)
            <li class="flex items-center gap-x-2 mb-4">
                <div class="avatar">
                    <div class="w-12 rounded">
                        @if ($user->profile_image_path == null)
                            <img src="{{ asset('default.png') }}" alt="プロフィール画像" />
                        @else
                            <img src="{{ Storage::url($user->profile_image_path) }}" alt="プロフィール画像" />
                        @endif
                    </div>
                </div>
                <div>
                    <div>
                        {{ $user->name }}
                    </div>
                    <div>
                        <p><a class="link link-hover text-info" href="{{ route('users.show', $user->id) }}">プロフィールを見る</a></p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $users->links() }}
@endif

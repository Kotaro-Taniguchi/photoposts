<div class="mt-4">
    @if (isset($posts))
        <ul class="list-none">
            @foreach ($posts as $post)
                <li class="flex items-start gap-x-2 mb-4">
                    <div class="avatar">
                        <div class="w-12 rounded">
                            @if ($post->user->profile_image_path == null)
                                <img src="{{ asset('default.png') }}" alt="プロフィール画像" />
                            @else
                                <img src="{{ Storage::url($post->user->profile_image_path) }}" alt="プロフィール画像" />
                            @endif
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザー詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $post->created_at }}</span>
                        </div>
                        @if ($post->image != null)
                            {{-- 投稿画像 --}}
                            <img src="{{ Storage::url($post->image->image_path) }}" alt="投稿画像" class="my-3 w-7/12 h-auto" />
                        @endif
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($post->post)) !!}</p>
                        </div>
                        <div>
                            @if (Auth::id() == $post->user_id)
                                {{-- 削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" onclick="return confirm('Delete id = {{ $post->id }} ?')">削除</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $posts->links() }}
    @endif
</div>

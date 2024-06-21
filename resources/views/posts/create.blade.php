@extends('layouts.app')

@section('content')
    {{-- 画像の選択、表示エリア --}}
    <div id="imageArea" class="max-w-xl mx-auto mt-0 mb-2 text-center">
        <div id="noView" class="max-w-full max-h-full px-28 py-40 border table-cell align-middle">
            <div>画像ファイルをドロップかクリックしてください。</div>
        </div>
        <canvas id="view" width="800" height="500" class="hidden max-w-full max-h-full"></canvas>
        <input id="image_file" name="image_file" type="file" class="hidden" accept="image/png, image/jpeg, image/gif">
    </div>
    <div class="max-w-xl mx-auto mt-0 mb-4 text-center">
        <div class="flex mt-2">
            <button id="sepia_button" type="button" class="w-1/3 btn bg-stone-400 hover:bg-stone-500">セピア化</button>
            <button id="back_button" type="button" class="w-1/3 btn bg-stone-400 hover:bg-stone-500">戻す</button>
            <button id="delete_button" type="button" class="w-1/3 btn btn-error">画像の削除</button>
        </div>
    </div>
    {{-- コメント投稿フォーム --}}
    <div class="max-w-xl mx-auto mt-0 mb-4 text-center">
        <form class="w-full">
            <div class="form-control mt-10 mb-6 text-2xl">
                コメント
            </div>
            <div class="form-control my-4">
                <textarea id="post" name="post" rows="5" class="border border-gray-500 rounded-lg"></textarea>
            </div>
            <button id="submit_button" type="button" class="w-full btn bg-blue-300 hover:bg-blue-400">投稿！</button>
        </form>
    </div>
    <script src="{{ asset('/js/imageArea.js') }}"></script>
    <script src="{{ asset('/js/sepiaAndDelete.js') }}"></script>
    <script src="{{ asset('/js/sendFormData.js') }}"></script>
@endsection

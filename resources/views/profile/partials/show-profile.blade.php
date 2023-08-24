<section>
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            アカウント情報
        </h2>

        <p class="mt-1 mb-4 text-sm text-gray-600">
            アカウント情報を更新できます。
        </p>
    </header>
        <div class="mb-4">
            <h3 class="text-1xl font-bold mb-4">【名前】</h3>
            <p>{{$user->name}}</p>
        </div>

        <div class="mb-4">
            <h3 class="text-1xl font-bold mb-4">【メールアドレス】</h3>
            <p>{{$user->email}}</p>
        </div>

        {{-- アバター更新用に追加 --}}
        <div class="mb-4">
            <h3 class="text-1xl font-bold mb-4">【プロフィール画像】</h3>
            <div class="rounded-full w-36">
                <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}">
            </div>
        </div>
        <x-primary-button class="bg-gray-700" onClick="history.back()">戻る</x-primary-button>

</section>

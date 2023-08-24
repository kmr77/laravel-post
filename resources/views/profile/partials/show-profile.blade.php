<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            アカウント情報
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            アカウント情報を更新できます。
        </p>
    </header>
        <div>
            <x-input-label for="name" :value="__('名前')" />
            <p>{{$user->name}}</p>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <p>{{$user->email}}</p>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

        </div>

        {{-- アバター更新用に追加 --}}
        <div>
            <x-input-label for="avatar" :value="__('プロフィール画像（任意・1MBまで）')" />
            <div class="rounded-full w-36">
                <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}">
            </div>
        </div>
        <x-primary-button class="bg-gray-700" onClick="history.back()">戻る</x-primary-button>

</section>

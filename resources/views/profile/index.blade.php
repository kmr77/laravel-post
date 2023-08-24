<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ユーザー一覧
        </h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-right mt-4"><a href="{{route('profile.reindex')}}">ゴミ箱を見る</a></p>
        <div class="mt-4 mb-6">
            <table class="text-left w-full border-collapse"> 
                <tr class="bg-green-600">
                    <th class="p-3 text-left text-white">＃</th>
                    <th class="p-3 text-left text-white">名前</th>
                    <th class="p-3 text-left text-white">Email</th>
                    <th class="p-3 text-left text-white">アバター</th>
                    <th class="p-3 text-left text-white">プラン</th>
                    <th class="p-3 text-left text-white">編集</th>
                    <th class="p-3 text-left text-white">論理削除</th>
                </tr>
                @foreach($users as $user) 
                <tr class="bg-white">
                    <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->id}}</td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->name}}</td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">{{$user->email}}</td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">
                        <div class="rounded-full w-12 h-12">
                            <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}">
                        </div>
                    </td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">
                        @if(($user->aplan === 1))
                            <span>A</span>
                        @endif
                        @if(($user->bplan === 1))
                            <span>B</span>
                        @endif
                        @if(($user->cplan === 1))
                            <span>C</span>
                        @endif
                    </td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">
                        <a href="{{route('profile.adedit', $user)}}"><x-primary-button class="bg-teal-700">編集</x-primary-button></a>
                    </td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">
                        <form method="post" action="{{route('profile.isdelete', $user)}}">
                            @csrf
                            @method('patch')
                            @if(!isset($admin)) 
                            {{--管理者のゴミ箱に移動だけ非表示にしたい--}}
                            <x-primary-button class="bg-gray-300 text-black" onClick="return confirm('ゴミ箱に移動しますか？');">ゴミ箱に移動</x-primary-button>
                        @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
         </div>
    </div>
</x-app-layout>
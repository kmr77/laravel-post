<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ゴミ箱
        </h2>
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-right mt-4"><a href="{{route('profile.index')}}">一覧に戻る</a></p>
        <div class="mt-4 mb-6">
            @if (count($users) == 0)
            削除したユーザーはいません。
            @else
            <table class="text-left w-full border-collapse"> 
                <tr class="bg-green-600">
                    <th class="p-3 text-left text-white">＃</th>
                    <th class="p-3 text-left text-white">名前</th>
                    <th class="p-3 text-left text-white">Email</th>
                    <th class="p-3 text-left text-white">アバター</th>
                    <th class="p-3 text-left text-white">復活</th>
                    <th class="p-3 text-left text-white">物理削除</th>
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
                        <form method="post" action="{{route('profile.restore', $user)}}">
                            @csrf
                            @method('patch')
                            <x-primary-button class="bg-blue-700">元に戻す</x-primary-button>
                        </form>
                    </td>
                    <td class="border-gray-light border hover:bg-gray-100 p-3">
                        <form method="post" action="{{route('profile.addestroy', $user)}}">
                            @csrf
                            @method('delete')
                            <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">物理削除</x-primary-button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif
         </div>
    </div>
</x-app-layout>
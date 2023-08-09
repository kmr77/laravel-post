<div class="mt-5">
    <h4 class="mb-3">プラン付与・変更（アドミンユーザーにのみ表示）</h4>
    
    <table class="text-left w-full border-collapse mt-8"> 
        <tr class="bg-green-600 text-center">
            <th>役割</th>
            <th>ON</th>
            <th>OFF</th>
        </tr>
        {{--ここに現在のプランを表示したいがuserがplan_idを持っているわけではないので表示は難しい？--}}
        現在設定中のプラン：
        <p>{{--$user->plans--}}</p>
        @foreach ($plans as $plan)
        <tr class="bg-white text-center">
            <td class="p-3">
                {{$plan->name}}
            </td>
            <td class="p-3">
                
                <form method="post" action="{{route('plan.attach', $user)}}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="plan" value="{{$plan->id}}">
                    <button class="btnroleb
                    @if($user->plans->contains($plan))
                        bg-gray-300
                        @endif
                        "
                        @if($user->plans->contains($plan))
                            disabled
                        @endif
                        >
                        設定する
                    </button>
                </form>
            </td>
            <td class="p-3">
                <form method="post" action="{{route('plan.detach', $user)}}">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="plan" value="{{$plan->id}}">
                        <button class="btnroler 
                        @if(!$user->plans->contains($plan))
                        bg-gray-300
                        @endif
                        "
                        @if(!$user->plans->contains($plan))
                            disabled
                        @endif
                        >
                        解除する
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
   </table>
</div>
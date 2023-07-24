<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{-- ここから貼り付けます --}}
            <div class="w-full container mx-auto">
                <div class="w-full flex items-center justify-between">
                    <a href="{{route('top')}}">
                        <img src="{{asset('logo/inu-logo.jpg')}}" style="max-height:80px;" alt="">
                    </a>
                    <div class="flex w-1/2 justify-end content-center">
                        {{-- ログイン・登録部分 --}}
                        @if (Route::has('login'))
                        <div class="hidden top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/post') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">HOME</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline font-bold text-base">ログイン</a>
        
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline font-bold text-base">登録</a>
                                @endif
                            @endauth
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            {{-- ここまで貼り付けた箇所 --}}
            <div class="w-full container mx-auto">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
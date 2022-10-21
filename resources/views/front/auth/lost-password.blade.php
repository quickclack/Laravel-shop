@extends('front.layouts.auth.layout')

@section('content')

    <!-- Page heading -->
    <div class="text-center">
        <a href="{{ route('home') }}" class="inline-block" rel="home">
            <img src="./images/logo.svg" class="w-[148px] md:w-[201px] h-[36px] md:h-[50px]" alt="CutCode">
        </a>
    </div>

    <div class="max-w-[640px] mt-12 mx-auto p-6 xs:p-8 md:p-12 2xl:p-16 rounded-[20px] bg-purple">
        <h1 class="mb-5 text-lg font-semibold">Восстановить пароль</h1>
        <form class="space-y-3" method="post" action="{{ route('forgot.update') }}">
            @csrf

            <input type="email" name="email"
                   class="w-full h-14 px-4 rounded-lg border border-[#A07BF0] bg-white/20 focus:border-pink focus:shadow-[0_0_0_2px_#EC4176] outline-none transition text-white placeholder:text-white text-xxs md:text-xs font-semibold"
                   placeholder="E-mail" required>
            <button type="submit" class="w-full btn btn-pink">Отправить</button>
        </form>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs"><a href="{{ route('registered') }}" class="text-white hover:text-white/70 font-bold">Регистрация</a>
            </div>
        </div>
        <div class="space-y-3 mt-5">
            <div class="text-xxs md:text-xs">
                <a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">Вспомнили или передумали?</a>
            </div>
        </div>
        <ul class="flex flex-col md:flex-row justify-between gap-3 md:gap-4 mt-14 md:mt-20">
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Пользовательское соглашение</a>
            </li>
            <li class="hidden md:block">
                <div class="h-full w-[2px] bg-white/20"></div>
            </li>
            <li>
                <a href="#" class="inline-block text-white hover:text-white/70 text-xxs md:text-xs font-medium"
                   target="_blank" rel="noopener">Политика конфиденциальности</a>
            </li>
        </ul>
    </div>
@endsection
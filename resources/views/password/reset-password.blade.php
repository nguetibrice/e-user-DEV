<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-USER - Réinitialisation de mot de passe</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
</head>

<body class="flex min-h-screen items-center justify-center bg-gray-100 px-2 py-8 antialiased dark:bg-gray-900 sm:px-0">
    <div class="max-w- sm:w-[32rem]">
        <div class="mb-6">
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/logo.png') }}" class="mx-auto h-[4rem]">
            </a>
        </div>

        <h1 class="mb-6 text-center text-xl font-bold">Réinitialisation de mot de passe</h1>

        @if (session('error'))
            <div class="relative mb-4 rounded border border-red-400 bg-red-100 px-4 py-4 text-red-700" role="alert">
                <b>{{ session('error') }}</b>
            </div>
        @endif

        <form class="mb-4 space-y-4 rounded bg-white px-8 pb-8 pt-6 shadow-lg shadow-gray-500/50 drop-shadow-2xl"
            method="POST" action="{{ route('password.reset', [], false) }}">
            <p class="font-semibold">Entrez votre nouveau mot de passe ci-dessous</p>
            @csrf
            <div class="space-y-2">
                <label class="block font-semibold" for="password">
                    Nouveau mot de passe
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    type="password" name="password" required autofocus>
            </div>
            <div class="space-y-2">
                <label class="block font-semibold" for="password_confirmation">
                    Confirmez le mot de passe
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    type="password" name="password_confirmation" required autofocus>
            </div>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
            <button
                class="focus:shadow-outline w-full rounded bg-gradient-to-r from-green-400 to-blue-500 px-4 py-2 font-bold text-white hover:from-pink-500 hover:to-yellow-500 focus:outline-none"
                type="submit">
                Réinitialiser
            </button>
        </form>

        <p class="text-center text-xs text-gray-500">
            &copy;2022 DJED. All rights reserved.
        </p>
    </div>
</body>

</html>

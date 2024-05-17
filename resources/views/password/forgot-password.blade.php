<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-USER - Mot de passe oublié</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="flex min-h-screen items-center justify-center bg-gray-100 px-2 py-8 antialiased dark:bg-gray-900 sm:px-0">
    <div class="max-w-sm sm:max-w-lg">
        <div class="mb-4">
            <a href="{{ route('login') }}">
                <img src="{{ asset('images/logo.png') }}" class="mx-auto h-[4rem]">
            </a>
        </div>

        <h1 class="mb-6 text-center text-xl font-bold">Mot de passe oublié</h1>

        @if (session('error'))
            <div class="relative mb-4 rounded border border-red-400 bg-red-100 px-4 py-4 text-red-700" role="alert">
                <b>{{ session('error') }}</b>
            </div>
        @elseif(session('success'))
            <div class="relative mb-4 rounded border border-green-400 bg-green-100 px-4 py-4 text-green-700"
                role="alert">
                <b>{{ session('success') }}</b>
            </div>
        @endif

        <form class="mb-4 space-y-4 rounded bg-white px-8 pb-8 pt-6 shadow-lg shadow-gray-500/50 drop-shadow-2xl"
            method="POST" action="{{ route('password.request', [], false) }}">
            <p class="font-semibold">Veuillez saisir votre adresse e-mail. Vous recevrez un lien pour
                créer un nouveau mot de passe par
                e-mail.</p>
            @csrf
            <div class="space-y-2">
                <label class="block font-semibold" for="email">
                    Votre addresse e-mail
                </label>
                <input
                    class="focus:shadow-outline w-full appearance-none rounded border px-3 py-2 leading-tight text-gray-700 shadow focus:outline-none"
                    type="email" name="email" required autofocus />
            </div>
            <button
                class="focus:shadow-outline w-full rounded bg-gradient-to-r from-green-400 to-blue-500 px-4 py-2 font-bold text-white hover:from-pink-500 hover:to-yellow-500 focus:outline-none"
                type="submit">
                Envoyer
            </button>
        </form>

        <p class="text-center text-xs text-gray-500">
            &copy;2022 DJED. All rights reserved.
        </p>
    </div>
</body>

</html>

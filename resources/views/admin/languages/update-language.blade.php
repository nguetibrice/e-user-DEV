<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Modification de la langue {{ $language['name'] }} - DJED</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100 antialiased dark:bg-gray-900">
    <div class="container mx-auto min-h-screen px-4">
        @include('partials.admin-header')

        <div class="mx-auto my-6 sm:w-[30rem]">
            @if (session('error'))
                <div class="relative mb-4 w-full rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('languages.update', ['id' => $language['id']], false) }}" method="post"
                class="w-full rounded bg-white shadow-lg shadow-gray-500/50">
                <div class="rounded-t border-b p-4 dark:border-gray-600">
                    <h3 class="text-black-900 text-center text-xl font-semibold dark:text-black">
                        Modification de langue
                    </h3>
                </div>
                @csrf
                <div class="space-y-6 p-6">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="name">Langue</label>
                        <input id="name"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="name" value="{{ $language['name'] }}" required autofocus
                            autocomplete="name" placeholder="Entrez le nom de la langue" />
                        @error('name')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="code">Code</label>
                        <input id="code"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="code" value="{{ $language['code'] }}" required autofocus
                            placeholder="Entrez un code pour la langue" />
                        @error('code')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="linguist">Linguiste</label>
                        <input
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="linguist" value="{{ $language['linguist'] }}" required autofocus
                            placeholder="Entrez le linguiste par defaut de la langue" />
                        @error('linguist')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="description">Description</label>
                        <textarea name="description" rows="8"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm">{{ $language['description'] }}</textarea>
                        @error('description')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="status" value="{{ $language['status'] }}">
                    <div class="mt-4 flex items-center justify-between space-x-4">
                        <button
                            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25"
                            id="deactivate">Desactiver</button>
                        <button type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">
                            Modifier
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="py-6">
            @include('partials.copyright-footer-section')
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $("#deactivate").on("click", function() {
        $("input[name='status']").val("0");
        $("form").submit();
    })
</script>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Gestion des Langues - DJED</title>

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

        <div class="my-4 flex justify-between">
            <h1 class="text-3xl font-bold">Langues</h1>
            <a href="{{ route('languages.create') }}" class="rounded-lg bg-blue-500 px-4 py-2 text-white">
                Ajouter une langue
            </a>
        </div>

        @if (session('error'))
            <div class="relative mb-4 w-full rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                role="alert">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div class="relative mb-4 w-full rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="mb-8 w-full bg-white">
            <thead>
                <th class="border-[1px] border-solid border-[#ddd] px-8 py-2">Code</th>
                <th class="border-[1px] border-solid border-[#ddd] px-8 py-2">Nom</th>
                <th class="border-[1px] border-solid border-[#ddd] px-4 py-2">Description</th>
                <th class="border-[1px] border-solid border-[#ddd] px-4 py-2">Statut</th>
                <th class="border-[1px] border-solid border-[#ddd] px-4 py-2">Actions</th>
            </thead>
            <tbody>
                @foreach ($languages as $language)
                    <tr>
                        <td class="border-[1px] border-solid border-[#ddd] px-4 py-2 text-center">
                            {{ $language['code'] }}</td>
                        <td class="border-[1px] border-solid border-[#ddd] px-4 py-2 text-center">
                            {{ $language['name'] }}</td>
                        <td class="border-[1px] border-solid border-[#ddd] px-4 py-2">{{ $language['description'] }}
                        </td>
                        <td class="border-[1px] border-solid border-[#ddd] px-4 py-2 text-center">
                            {{ $language['status'] == 1 ? 'Actif' : 'Inactif' }}</td>
                        <td class="space-y-2 border-[1px] border-solid border-[#ddd] px-4 py-2">
                            <a href="{{ route('languages.edit', ['id' => $language['id']]) }}"
                                class="block w-full rounded-lg bg-gray-500 px-4 py-2 text-center text-white">
                                Modifier
                            </a>
                            <button id="deletion_button"
                                data-url="{{ route('languages.delete', ['id' => $language['id']]) }}"
                                onclick="deleteLanguage('{{ $language['id'] }}')"
                                class="block w-full rounded-lg bg-red-500 px-4 py-2 text-center text-white">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="py-6">
            @include('partials.copyright-footer-section')
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function deleteLanguage(id) {
        Swal.fire({
            title: "Voulez vous vraiment supprimer cette langue ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui",
            cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                const token = $('meta[name="csrf-token"]').attr('content');
                const deletion_url = $("#deletion_button").data('url');

                $.ajax({
                    url: deletion_url,
                    type: "DELETE",
                    data: {
                        _token: token,
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            html: '<b>LANGUE EN COURS DE SUPPRESSION...</b>',
                            timer: 10000,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            willClose: () => {
                                clearInterval(10000)
                            }
                        })
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: response[0],
                            title: '<b>' + response[1] + '</b>',
                            timer: 3000,
                            timerProgressBar: true
                        })
                        location.reload(true);
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: error[0],
                            title: error[1],
                            timer: 3000,
                            timerProgressBar: true
                        })
                    }
                });
            }
        });
    }
</script>

</html>

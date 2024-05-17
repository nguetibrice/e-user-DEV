<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inscription - DJED</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
</head>
<style>
    .error {
        border-color: #B91C1C;
    }
</style>

<body class="bg-gray-100 pb-8 antialiased dark:bg-gray-900">
    <div class="container mx-auto min-h-screen px-4">
        <div class="flex items-center justify-between py-4">
            <a href="{{ route('login') }}"><img src="{{ asset('images/logo.png') }}" class="h-[4rem]"></a>
            <a href="{{ route('register-with-code') }}"
                class="focus:shadow-outline rounded bg-gradient-to-r from-green-400 to-blue-500 px-4 py-2 font-bold text-white hover:from-pink-500 hover:to-yellow-500 focus:outline-none">
                Inscription avec Code
            </a>
        </div>

        <div class="mx-auto mb-4 w-fit">
            @if (session('error'))
                <div class="relative mb-4 w-full rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert">
                    {{ session('error') }}
                </div>
            @elseif ($errors->any())
                <div class="relative mb-4 w-full rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700"
                    role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @elseif (session('success'))
                <div class="relative mb-4 w-full rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif


            <form class="w-full rounded bg-white shadow-lg shadow-gray-500/50" method="POST"
                action="{{ route('register', [], false) }}" enctype="multipart/form-data" id="inscription">
                @csrf
                <div class="rounded-t border-b p-4 dark:border-gray-600">
                    <h3 class="text-black-900 text-center text-xl font-semibold dark:text-black">
                        Complete Profile
                    </h3>
                </div>
                <div class="grid grid-cols-6 gap-6 p-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="first_name">Prénom <code class="text-red-500">*</code> </label>
                        <input id="firstname"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="first_name" value="{{ $user['first_name'] }}" autofocus
                            autocomplete="firstname" placeholder="Entrez votre prénom" readonly/>
                        <span class="error text-red-700" id="error_first_name"></span>
                        @error('first_name')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                        {{-- @if (session('error'))
                            <span class="error text-red-700">
                                @php
                                    $errors=explode('|',session('error'));
                                    $error;
                                    foreach ($errors as $key => $value) {

                                        if ($value.includes("name")) {
                                            $error=$errors[$key];
                                        }
                                    }

                                   echo $error;
                                @endphp
                            </span>
                        @endif --}}
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-black"
                            for="last_name">Nom <code class="text-red-500">*</code></label>
                        <input id="lastname"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="last_name" value="{{ $user['last_name'] }}"
                            placeholder="Entrez votre nom" autofocus autocomplete="lastname" readonly/>
                        <span class="error text-red-700" id="error_lastname"></span>
                        @error('last_name')
                            <span class="error text-red-700">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="birthday" class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Date
                            de naissance <code class="text-red-500">*</code></label>
                        <input type="date" name="birthday" value="{{ $user['birthday'] }}"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm" readonly>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="phone"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Téléphone <code class="text-red-500">*</code></label>
                        <input id="phone" wire:model="phone"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" placeholder="Entrez votre numéro de téléphone" name="phone"
                            value="{{ $user['phone'] }}" autofocus autocomplete="phone" readonly/>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="email"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Email <code class="text-red-500">*</code></label>
                        <input id="email" wire:model="email"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="email" placeholder="Entrez votre e-mail" name="email"
                            value="{{ $user['email'] }}" readonly/>
                        <span class="error text-red-700" id="error_email"></span>

                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="date"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Alias <code class="text-red-500">*</code></label>
                        <input id="date" wire:model="alias"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="alias" value="{{ $user['alias'] }}" autofocus autocomplete="alias"
                            placeholder="Choisissez un alias personnel" />
                        <span class="error text-red-700" id="error_alias"></span>

                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="password" class="text-black-900 mb-2 block text-sm font-medium dark:text-black">Mot
                            de
                            passe <code class="text-red-500">*</code></label>
                        <input id="password" wire:model="password"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="password" name="password" autocomplete="new-password" />
                        <span class="error text-red-700" id="error_password"></span>

                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_confirmation"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Confirmez le mot de
                            passe <code class="text-red-500">*</code></label>
                        <input id="password_confirmation"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="password" name="password_confirmation" autocomplete="new-password" />
                        <span class="error text-red-700" id="error_password_confirmation"></span>

                    </div>
                    <div class="col-span-6 sm:col-span-3" id="tutor-container">
                        <label for="guardian"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-black">Tuteur (CIP,Alias ou Telephone)</label>
                        <input id="guardian"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-600 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500 sm:text-sm"
                            type="text" name="guardian" value="" />
                        <span class="error text-red-700" id="error_guardian"></span>

                    </div>
                    <input id="cip" type="hidden" name="cip" value="{{ $user["cip"] }}" />
                </div>
                <div class="p-6">
                    <input type="checkbox" required name="contract" id="contract" checked>
                    <span class="text-sm">
                        J'accept que les données que j'ai remplies sont exactes.
                    </span>
                </div>
                <div
                    class="mt-4 flex items-center justify-end space-x-4 rounded-b border-t border-gray-200 p-6 dark:border-gray-600">
                    <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ url("/login") }}">
                        {{ __('Déjà Inscrit?') }}
                    </a>
                    <button wire.click="register" name="inscription" id="btn_inscription"
                        class="ml-4 inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">
                        {{ __("Completer Profile") }}
                    </button>
                </div>
            </form>
        </div>

        @include('partials.copyright-footer-section')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>


    <script>
        // charge variable
        var inputs = document.getElementById("inscription").getElementsByTagName("input");
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@%-+_!.,@#$^&?%éè]).+$/;
        const regex_email = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

        // verifie validation of form
        function formValide() {

            if (!inputs['first_name'].value) {
                document.getElementById('error_first_name').innerHTML = 'Veuillez remplir ce champ'
                inputs['first_name'].classList.add("error")
            }
            if (inputs['first_name'].value.length <= 3) {
                document.getElementById('error_first_name').innerHTML = 'ce champ doit contenir au moins 4 caractères'
                inputs['first_name'].classList.add("error")

            }
            if (inputs['first_name'].value.length > 24) {
                document.getElementById('error_first_name').innerHTML = 'ce champ doit contenir au moins 24 caractères'
                inputs['first_name'].classList.add("error")

            }
            if (!inputs['lastname'].value) {
                document.getElementById('error_lastname').innerHTML = 'Veuillez remplir ce champ'
                inputs['lastname'].classList.add("error")

            }

            if (inputs['lastname'].value.length <= 3) {
                document.getElementById('error_lastname').innerHTML = 'ce champ doit contenir au moins 4 caractères'
                inputs['lastname'].classList.add("error")

            }

            if (inputs['lastname'].value.length > 24) {
                document.getElementById('error_lastname').innerHTML = 'ce champ doit contenir au moins 24 caractères'
                inputs['lastname'].classList.add("error")

            }

            if (!inputs['alias'].value) {
                document.getElementById('error_alias').innerHTML = 'Veuillez remplir ce champ'
                inputs['alias'].classList.add("error")

            }

            if (inputs['alias'].value.length < 3) {
                document.getElementById('error_alias').innerHTML = 'ce champ doit contenir au moins 4 caractères'
                inputs['alias'].classList.add("error")

            }

            if (inputs['alias'].value.length > 24) {
                document.getElementById('error_alias').innerHTML = 'ce champ doit contenir au moins 24 caractères'
                inputs['alias'].classList.add("error")

            }

            if (!regex_email.test(inputs['email'].value)) {
                document.getElementById('error_email').innerHTML = 'Veuillez remplir ce champ with email'
                inputs['email'].classList.add("error")

            }
            if (!regex.test(inputs['password'].value) || inputs['password'].value.length < 7) {
                document.getElementById('error_password').innerHTML =
                    'ce champ doit contenir au moins 8 caractères <br> Doit contenir au moins une lettre minuscule <br>  Doit contenir au moins une lettre majuscule <br> Doit contenir au moins un chiffre <br> Doit contenir au moins un caractère specifique (?=.*[@%-+_!.,@#$^&?%éè]) <br> Exemple de mot de passe: MotDePasse123!'
                inputs['password'].classList.add("error")
            }

            if (inputs['password'].value != inputs['password_confirmation'].value) {
                console.log('test');
                document.getElementById('error_password_confirmation').innerHTML =
                    'ce champ doit être identique au champ mot de passe'
                inputs['password_confirmation'].classList.add("error")
            }
            if (!inputs['contract'].checked) {
                inputs['contract'].style.borderColor = "#B91C1C"
            }



        }


        // to submit form
        document.getElementById("btn_inscription").addEventListener("click", function(e) {
            e.preventDefault();
            formValide();
            if (inputs['first_name'].value &&
                inputs['first_name'].value.length >= 3 &&
                inputs['first_name'].value.length < 24 &&
                inputs['lastname'].value &&
                inputs['lastname'].value.length >= 3 &&
                inputs['lastname'].value.length < 24 &&
                inputs['alias'].value &&
                inputs['alias'].value.length >= 3 &&
                inputs['alias'].value.length < 24 &&
                inputs['password'].value &&
                inputs['password'].value.match(regex) &&
                inputs['contract'].checked
                ) {
                document.getElementById("inscription").submit();
            }
        });

        // verifie caractere that the user input
        inputs['first_name'].addEventListener("keyup", function(e) {

            if (inputs['first_name'].value &&
                inputs['first_name'].value.length >= 3 &&
                inputs['first_name'].value.length < 24) {
                document.getElementById('error_first_name').innerHTML = ''
                this.classList.remove("error");
            }

        });
        inputs['first_name'].addEventListener("blur", function(e) {

            document.getElementById('error_first_name').innerHTML = ''
            this.classList.remove("error")
            if (!inputs['first_name'].value) {
                document.getElementById('error_first_name').innerHTML = 'Veuillez remplir ce champ'
                this.classList.add("error")
            }
            if (inputs['first_name'].value.length <= 3) {
                document.getElementById('error_first_name').innerHTML =
                    'ce champ doit contenir au moins 4 caractères'
                this.classList.add("error")

            }
            if (inputs['first_name'].value.length > 24) {
                document.getElementById('error_first_name').innerHTML =
                    'ce champ doit contenir au moins 24 caractères'
                this.classList.add("error")

            }
        });
        inputs['lastname'].addEventListener("keyup", function(e) {


            if (inputs['lastname'].value &&
                inputs['lastname'].value.length >= 3 &&
                inputs['lastname'].value.length < 24) {
                document.getElementById('error_lastname').innerHTML = ''
                this.classList.remove("error")
            }

        });
        inputs['lastname'].addEventListener("blur", function(e) {


            if (!inputs['lastname'].value) {
                document.getElementById('error_lastname').innerHTML = 'Veuillez remplir ce champ'
                this.classList.add("error")

            }
            if (inputs['lastname'].value.length <= 3) {
                document.getElementById('error_lastname').innerHTML = 'ce champ doit contenir au moins 4 caractères'
                this.classList.add("error")

            }
            if (inputs['lastname'].value.length > 24) {
                document.getElementById('error_lastname').innerHTML =
                    'ce champ doit contenir au moins 24 caractères'
                this.classList.add("error")

            }
        });
        inputs['alias'].addEventListener("keyup", function(e) {


            if (inputs['alias'].value && inputs['alias'].value.length >=3  && inputs['alias'].value.length < 24) {
                document.getElementById('error_alias').innerHTML = ''
                this.classList.remove("error")
            }

        });
        inputs['alias'].addEventListener("blur", function(e) {


            if (!inputs['alias'].value) {
                document.getElementById('error_alias').innerHTML = 'Veuillez remplir ce champ'
                this.classList.add("error")

            }
            if (inputs['alias'].value.length <= 3) {
                document.getElementById('error_alias').innerHTML = 'ce champ doit contenir au moins 4 caractères'
                this.classList.add("error")

            }
            if (inputs['alias'].value.length > 24) {
                document.getElementById('error_alias').innerHTML = 'ce champ doit contenir au moins 24 caractères'
                this.classList.add("error")

            }
        });
        inputs['email'].addEventListener("keyup", function(e) {
            if (regex_email.test(inputs['email'].value)) {
                document.getElementById('error_email').innerHTML = ''
                this.classList.remove("error")
            }
        });
        inputs['email'].addEventListener("blur", function(e) {


            if (!regex_email.test(inputs['email'].value)) {
                document.getElementById('error_email').innerHTML = 'Veuillez remplir ce champ un email'
                this.classList.add("error")

            }

        });
        inputs['password'].addEventListener("keyup", function(e) {
            if (regex.test(inputs['password'].value)) {
                document.getElementById('error_password').innerHTML = ''
                this.classList.remove("error")
            }

        });
        inputs['password'].addEventListener("blur", function(e) {

            if (!regex.test(inputs['password'].value) || inputs['password'].value.length <= 7) {
                document.getElementById('error_password').innerHTML =
                    'ce champ doit contenir au moins 8 caractères <br> Doit contenir au moins une lettre minuscule <br>  Doit contenir au moins une lettre majuscule <br> Doit contenir au moins un chiffre <br> Doit contenir au moins un caractère specifique (?=.*[@%-+_!.,@#$^&?%éè]) <br> Exemple de mot de passe: MotDePasse123!'
                this.classList.add("error")

            }
        });
        inputs['password_confirmation'].addEventListener("keyup", function(e) {
            if (inputs['password'].value === inputs['password_confirmation'].value) {
                document.getElementById('error_password_confirmation').innerHTML = ''
                inputs['password_confirmation'].classList.remove("error")

            }
            setTimeout(() => {
                if (inputs['password'].value != inputs['password_confirmation'].value) {

                    document.getElementById('error_password_confirmation').innerHTML =
                        'ce champ doit être identique au champ mot de passe'
                    inputs['password_confirmation'].classList.add("error")

                }
            }, 1000);

        });

    </script>
</body>

</html>

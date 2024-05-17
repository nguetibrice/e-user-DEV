@extends('layouts.maindo')

@Section('titre')
    Recharge du wallet
@endsection

@Section('content')
    <div class="mt-8 mx-4 justify-center">
        <div class="container grid grid-cols-1">
            <div class="flex justify-center">
                <div class="">
                    <h1 class="text-center mb-7 text-gray-500 text-xl">
                        <strong class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                            CHOISIR MODE DE PAIEMENT
                        </strong>
                    </h1>
                    <div class="d-flex justify-content-around bg-blu-200 h-12">
                        <button id="master"
                            class="divide-y-4 h-full border-2  rounded-lg divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                            <img src="{{ asset('/image/master.png') }}" alt="" class="rounded-lg w-full h-full">
                        </button>
                        <button id="visa"
                            class="divide-y-4 h-full  border-2 rounded-lg  divide-slate-400/25 block bg-white shadow-md hover:shadow-xl mx-4">
                            <img src="{{ asset('/image/visa.png') }}" alt="" class="rounded-lg w-23 h-10">
                        </button>
                        @foreach ($payment_methods as $method)
                            @if($method["status"] == 1)
                                @switch($method["code"])
                                    @case("PAYPAL")
                                        <button id="paypal"
                                            class="divide-y-4 h-full mx-4 ml-6 border-2 rounded-lg  divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                                            <img src="{{ asset('/image/paypale.png') }}" alt="" class="rounded-lg w-23 h-10">
                                        </button>
                                    @break
                                    @case("OM")
                                        <button id="om"
                                            class="divide-y-4 h-full mx-4 border-2  rounded-lg divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                                            <img src="{{ asset('/image/orange.png') }}" alt="" class="rounded-lg w-23 h-10">
                                        </button>
                                    @break
                                    @case("MOMO")
                                        <button id="momo"
                                            class="divide-y-4 h-full mx-4 border-2  rounded-lg divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                                            <img src="{{ asset('/image/momo.png') }}" alt="" class="rounded-lg w-full h-full">
                                        </button>
                                    @break
                                    @default

                                @endswitch

                            @endif
                        @endforeach
                    </div>
                    <br>
                    <br>
                    <div class="d-flex justify-content-center">
                        <div id="fmaster" class="w-full max-w-xs justify-self-center float-center" style="display: none;">
                            <form action="" id="form-master">
                                <div class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4"
                                    id="mastercard" action="{{ route('recharge.create', [] , false) }}">
                                    <h1 class="text-center mb-4 text-gray-500 text-xl ">
                                        <strong
                                            class="bg-clip-text float-right text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                                            <img src="{{ asset('/image/master.png') }}" alt="" class="rounded-lg w-20 h-10" id="card-img">
                                        </strong>
                                    </h1><br>
                                    <div class="mb-4">
                                        {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Nom sur la carte
                                        </label> --}}
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="mascarte" type="text" placeholder="nom sur la carte" name="nom_carte" required
                                            value="card" disabled autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Montant
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            type="number" id="masamount" name="amount" placeholder="1000" required
                                            autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            numero de la carte
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="masnumero" type="text" name="numero_carte" placeholder="0000 0000 0000 0000" required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Mois d'expiration
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="masmois_month" type="month" name="mois_month" placeholder="MM" required autofocus min="1" max="12" maxlength="2">
                                    </div>
                                    {{-- <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Année d'expiration
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="masannee_year" type="year" name="annee_year" placeholder="YY" required autofocus maxlength="2">
                                    </div> --}}
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            CVV
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="mascvv" type="number" name="cvc" placeholder="code secret à 3 chiffres" required
                                            autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            ville
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="masville" type="text" name="ville" placeholder="Yaounde" required
                                            autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Code postal
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="maspost" type="text" name="post" placeholder="12345" required
                                            autofocus>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            pays
                                        </label>
                                        <select name="pays" id="maspays"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="CM">Cameroun</option>
                                            <option value="US">USA</option>
                                            <option value="GB">England</option>
                                            <option value="CA">Canada</option>
                                            <option value="FR">France</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Devise
                                        </label>
                                        <select name="currency" id="mascurrency"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach ($currencies as $currency)
                                            <option value="{{ $currency["code"] }}" {{ $currency["code"] == "CAD"?"selected":"" }}>{{ $currency["code"] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                            Telephone
                                        </label>
                                        <input
                                            class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="masphone" type="text" name="phone" placeholder="678787676" required
                                            autofocus>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <button type="submit" id="payer"
                                            class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Recharger
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>

                        {{-- Visa --}}
                        <div id="fvisa" class="w-full max-w-xs" style="display: none;">
                            @php
                                $route = route('payment.stripe', [], false);
                                if (env('APP_ENV') === 'production') {
                                    $route = env('APP_URL') . $route;
                                }
                            @endphp
                            <form class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4"
                                id="visacard" action="{{ $route }}">
                                @csrf
                                <h1 class="text-center mb-4 text-gray-500 text-xl ">
                                    <strong
                                        class="relative bg-clip-text float-right text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                                        <img src="{{ asset('/image/visa.png') }}" alt="" class="rounded-lg w-23 h-10">
                                    </strong>
                                </h1><br>
                                <div class="mb-4">
                                    {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Nom sur la carte
                                    </label> --}}
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="visacarte" type="text" placeholder="Mastercard" name="nom_carte" value="card"
                                        required disabled autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        numero de la carte
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="visanumero" type="text" name="numero_carte" placeholder="0000 0000 0000 0000"
                                        required autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Date d'expiration
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="visadate" type="text" name="date" placeholder="MM/YY" required autofocus>
                                </div>

                                <div class="mb-'">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        CVV
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="visacvv" type="text" name="cvv" placeholder="code secret à 3 chiffres"
                                        required autofocus>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        Payer
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Paypal --}}
                        {{-- <div id="fpaypal" class="w-full max-w-xs" style="display: none;">

                            <form class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4"
                                id="paypal" action="{{ $route }}">
                                @csrf
                                <h1 class="text-center mb-4 text-gray-500 text-xl ">
                                    <strong
                                        class="bg-clip-text text-transparent float-right bg-gradient-to-r from-pink-500 to-violet-500">
                                        <img src="{{ asset('/image/paypale.png') }}" alt=""
                                            class="rounded-lg w-23 h-10">
                                    </strong>
                                </h1><br>
                                <div class="mb-4">
                                    {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Nom sur la carte
                                    </label> -}}
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="paycarte" placeholder="nom sur la carte" type="text" name="nom_carte" required
                                        value="card" required disabled autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        numero de la carte
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="paynumero" type="text" name="numero_carte" placeholder="0000 0000 0000 0000"
                                        required autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Date d'expiration
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="paydate" type="text" name="date" placeholder="MM/YY" required autofocus>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        CVV
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="paycvv" type="text" name="cvv" placeholder="code secret à 3 chiffres"
                                        required autofocus>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        Payer
                                    </button>
                                </div>
                            </form>
                        </div> --}}

                        {{-- orange money --}}
                        <div id="fom" class="w-full max-w-xs justify-self-center" style="display: none;">

                            @php
                                $route = route('recharge.create', [], false);
                                if (env('APP_ENV') === 'production') {
                                    $route = env('APP_URL') . $route;
                                }
                            @endphp
                            <form class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4" action="{{ $route }}" method="POST">
                                @csrf
                                <h1 class="text-center mb-4 text-gray-500 text-xl ">
                                    <strong
                                        class="bg-clip-text text-transparent float-right bg-gradient-to-r from-pink-500 to-violet-500">
                                        <img src="{{ asset('/image/orange.png') }}" alt="" class="rounded-lg w-23 h-10">
                                    </strong>
                                </h1><br>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Montant net à payer
                                    </label>
                                    <input
                                        class="shadow appearance-none border cursor-not-allowed rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="numero" type="number" name="amount" required
                                        autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Telephone
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="telephone" type="tel" name="phone" placeholder="" required
                                        autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        ville
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="masville" type="text" name="city" placeholder="" required
                                        autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Code postal
                                    </label>
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 mx-1/2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="maspost" type="text" name="postal_code" placeholder="" required
                                        autofocus>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        pays
                                    </label>
                                    <select name="currency" id="mascurrency"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach ($currencies as $currency)
                                            <option value="{{ $currency["code"] }}" {{ $currency["code"] == "CAD"?"selected":"" }}>{{ $currency["code"] }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Devise
                                    </label>
                                    <select name="currency" id="currency"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="XAF">XAF</option>
                                        <option value="XOF">XOF</option>
                                        {{-- <option value="GB">England</option> --}}
                                    </select>
                                </div>

                                <div class="flex items-center justify-between">
                                    <button
                                        class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        Payer
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Mobile money --}}
                        {{-- <div id="fmomo" class="w-full max-w-xs" style="display: none;">

                            @php
                                $route = route('payment.stripe', [], false);
                                if (env('APP_ENV') === 'production') {
                                    $route = env('APP_URL') . $route;
                                }
                            @endphp
                            <form class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4">
                                @csrf
                                <h1 class="text-center mb-4 text-gray-500 text-xl ">
                                    <strong
                                        class="bg-clip-text text-transparent float-right bg-gradient-to-r from-pink-500 to-violet-500">
                                        <img src="{{ asset('/image/momo.png') }}" alt="" class="rounded-lg w-20 h-10">
                                    </strong>
                                </h1><br>
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Montant net à payer
                                    </label>
                                    <input
                                        class="shadow appearance-none border cursor-not-allowed rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="montant" type="tel" name="montant" placeholder="15 000 XAF" required autofocus
                                        disabled>
                                </div>
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                        Numero de téléphone
                                    </label>
                                    <input
                                        class="shadow appearance-none border-2 rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="numero" type="tel" name="numero"
                                        placeholder="Saisir numero de téléphone ici" required autofocus>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button
                                        class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                        type="submit">
                                        Payer
                                    </button>
                                </div>
                            </form>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $("#fmaster").show(2000);

            $('#master').click(function() {
                $('#fmaster').hide(1000);
                $('#fvisa').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fom').hide(1000);
                $('#fmomo').hide(1000);
                $('#card-img').attr("src","{{ asset('/image/master.png') }}")
                $('#fmaster').show(1000);
            });

            $('#visa').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fom').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                $('#card-img').attr("src","{{ asset('/image/visa.png') }}")
                $('#fmaster').show(1000);
            });

            $('#paypal').click(function() {
                $('#fmaster').hide(1000);
                $('#fom').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                $('#fpaypal').show(1000);
            });

            $('#om').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                $('#fom').show(1000);
            });

            $('#momo').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fom').hide(1000);
                $('#fvisa').hide(1000);
                $('#fmomo').show(1000);
            });

            document.getElementById("form-master").addEventListener("submit", (event) => {
            console.log(event);
            event.preventDefault();
            if (document.getElementById("masnumero") == "") {
                evenement.preventDefault();
                document.getElementById("masnumero").focus();
                return false;
            }
            Swal.fire({
                title: "Valider le paiement ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OUI Payer",
                cancelButtonText: "Cancel",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {

                    let token = $('meta[name="csrf-token"]').attr('content');
                    const urled = $("#mastercard").attr('action');
                    let formData = {
                        payment_method: {
                        type: "card",
                        card: {
                            number: $('#masnumero').val(),
                            exp_month: parseInt($('#masmois_month').val().substring(5)),
                            exp_year: parseInt($('#masmois_month').val().substring(2,4)),
                            cvc: $('#mascvv').val(),
                        }
                        },
                        address: {
                            city: $('#masville').val(),
                            country: $('#maspays').val(),
                            phone: $('#masphone').val(),
                            postal_code: $('#maspost').val(),
                            state: $('#maspays').val(),
                        },
                        amount: $('#masamount').val(),
                        currency: $('#mascurrency').val(),
                            _token: token,
                        };
                        console.log(formData);
                    $.ajax({
                        url: urled,
                        type: "POST",
                        data: formData,
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>PAIEMENT EN COURS...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    if (typeof timerInterval != "undefined") {
                                        clearInterval(timerInterval)
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: "Erreur lors du paiement, veillez essayer plus tard",
                                            timer: 3000,
                                            timerProgressBar: false
                                        });
                                    }
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response["status"] == "success") {
                                Swal.fire({
                                    icon: response["status"],
                                    title: "Paiement éffectué avec succès",
                                    timer: 20000,
                                    timerProgressBar: false,
                                    willClose: () => {
                                        window.location.href = "{{ route('dashboard') }}";
                                    }
                                })
                                //location.reload(true);
                            }
                            if (response["status"] === 'error') {
                                if (response["reason"] === 'Technical error. Try later') {
                                    Swal.fire({
                                        icon: response["status"],
                                        title: response["exception"]["message"],
                                        timer: 20000,
                                        timerProgressBar: false
                                    })
                                } else {
                                    Swal.fire({
                                        icon: response["status"],
                                        title: response["reason"],
                                        timer: 20000,
                                        timerProgressBar: false
                                    })
                                }

                            }
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: 'error',
                                title: "veillez à bien remplir les champs svp",
                                timer: 3000,
                                timerProgressBar: false
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: "Action annulée",
                        timer: 3000,
                        timerProgressBar: true
                    })
                }
            });

            })

        });
    </script>
@endsection

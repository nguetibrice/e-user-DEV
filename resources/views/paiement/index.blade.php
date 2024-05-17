@extends('layouts.maindo')

@Section('titre')
    Paiements
@endsection

@Section('content')
    <div class="mt-8 mx-4 ">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <div class="ml-10 mx-2">
                <h1 class="text-left mb-7 text-gray-500 text-xl">
                    <strong class="bg-clip-text text-transparent bg-gradient-to-r from-pink-500 to-violet-500">
                        CHOISIR MODE DE PAIEMENT
                    </strong>
                </h1>
                <div class="d-flex justify-content-around bg-blu-200 h-12">
                    <button id="master"
                        class="divide-y-4 h-full   border-2  rounded-lg divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                        <img src="{{ asset('/image/master.png') }}" alt="" class="rounded-lg w-15 h-full">
                    </button>
                    <button id="visa"
                        class="divide-y-4 h-full  border-2 rounded-lg  divide-slate-400/25 block bg-white shadow-md hover:shadow-xl ml-4">
                        <img src="{{ asset('/image/visa.png') }}" alt="" class="rounded-lg w-15 h-10">
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
                                        class="divide-y-4 h-full border-2  rounded-lg divide-slate-400/25 block bg-white shadow-md hover:shadow-xl">
                                        <img src="{{ asset('/image/momo.png') }}" alt="" class="rounded-lg w-full h-full">
                                    </button>
                                @break
                                @default

                            @endswitch

                        @endif
                    @endforeach
                    <button id="generate-link" data-te-toggle="tooltip" data-te-placement="top" title="Genere Lien de paiement pour payer par vous meme ou partager a vos proches"
                        class="btn btn-outline-dark shadow-md hover:shadow-xl">
                        <img src="{{ asset('/image/payment-link.png') }}" alt="" class="rounded-lg w-15 h-10">
                    </button>
                    <button id="wallet"
                        class="divide-y-4 h-full  border-2 rounded-lg  divide-slate-400/25 block bg-white shadow-md hover:shadow-xl ml-4">
                        <img src="{{ asset('/image/wallet.png') }}" alt="" class="rounded-lg w-23 h-10">
                    </button>
                </div>
                <br>
                <br>
                <div id="fmaster" class="w-full max-w-xs md:justify-center float-center" style="display: none;">
                    <form action="" onsubmit="payMaster(event)" id="form-master">
                        <div class="bg-white shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded px-8 pt-6 pb-8 mb-4"
                            id="mastercard" action="{{ route('payment.stripe', [] , false) }}">
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
                                    numero de la carte
                                </label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="masnumero" type="text" name="numero_carte" placeholder="0000 0000 0000 0000" required
                                    autofocus>
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
                            <div class="flex items-center justify-between">
                                <button type="submit" id="payer"
                                    class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Payer
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
                <div id="fom" class="w-full max-w-xs" style="display: none;">

                    @php
                        $route = route('payment.om', [], false);
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
                                id="numero" type="text" name="numero_carte" value="{{ $infos["price"] }}" required
                                autofocus disabled>
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
                            <select name="country" id="maspays"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Pays</option>
                                <option value="CM">Cameroun</option>
                                <option value="US">USA</option>
                                <option value="GB">England</option>
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



            {{-- Facture card --}}
            <div
                class="p-6 mx-10 mr-2 sm:rounded-lg shadow-lg shadow-cyan-500/50 drop-shadow-2xl rounded">
                <h3 class="text-2xl sm:text-2xl text-gray-800 dark:text-white font-extrabold tracking-tight">
                    Récapitulatif Bouquet
                </h3>
                <p class="text-normal text-lg sm:text-2xl mt-4 font-medium text-gray-600 dark:text-gray-400">
                    <input type="hidden" id="name" value="{{ $infos['langue'] }}">
                    Langue : <b>{{ $infos['langue'] }}</b>
                </p><br />
                <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class="text-md tracking-wide font-semibold w-40"><b>Mode de Paiement </b></div>
                    <div class="float-right flex mr-20 text-md tracking-wide font-semibold w-40">
                        <img src="{{ asset('/image/momo.png') }}" alt="" class="rounded-lg w-15 h-10">
                        <img src="{{ asset('/image/orange.png') }}" alt="" class="ml-4 w-13 h-10">

                    </div>
                </div>

                <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class="text-md tracking-wide font-semibold w-40"><b>Bouquet : </b></div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40"><i>{{ $infos['bouquet'] }}</i>
                        <input type="hidden" value="{{ $infos['bouquet'] }}">
                        <input type="hidden" id="price_id" value="{{ $infos['price_id'] }}">
                    </div>
                </div><br>
                <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class="text-md tracking-wide font-semibold w-40"><b>Nombre de places : </b></div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40">
                        <i><b>{{ $infos['place'] }}</b></i>
                        <input type="hidden" id="qtity" value="{{ $infos['place'] }}">
                    </div>
                </div><br>
                {{-- <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class="text-md tracking-wide font-semibold w-40"><b>Durée de l'abonnement </b></div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40">
                        <i>
                            <select id="duree"
                                class="bg-gray-50 border text-align-center border-gray-300 text-gray-900 h-8 w-40 text-sm rounded-lg">
                                <option selected>Choix de la période</option>
                                <option value="Annuel">Annuel</option>
                                <option value="Mensuel">Mensuel</option>
                            </select>
                        </i>
                    </div>
                </div><br> --}}
                <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class=" text-md tracking-wide font-semibold w-40"><b>price selon la durée </b></div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40"><b><i id="price"><input
                                    type="hidden" id="somme" value="{{ $infos['price'] }}"> </i></b>
                    </div>
                </div><br>
                <div class="mt-6 mx-2 w-full inline-flex justify-between">
                    <div class=" text-md tracking-wide font-semibold w-40"><b>telephone : </b></div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40"><i>(+237)
                            695055384</i>
                        <input type="hidden" id="phone" value="695055384">
                    </div>
                </div><br />
                <hr class="mt-12">
                <div class="mt-12 mx-2 w-full inline-flex justify-between justify-end">
                    <div class="ml-4 text-md tracking-wide font-semibold w-40">
                        <b>TOTAL : {{ $infos['price'] }} {{ $infos['monnais'] }}

                        </b>
                    </div>
                    <div class="float-right ml-4 text-md tracking-wide font-semibold w-40">
                        <input type="hidden"
                            id="total" value="{{ $infos['place'] }}"><b id="pricetotal"> </b>

                    </div>
                </div>

            </div>
            {{-- end facture card --}}
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            let checkoutLink = "";
            $('#duree').on('change', function() {
                var selectVal = $("#duree option:selected").val();
                var price = $('#somme').val();
                var total = $('#total').val();
                console.log(selectVal);
                if (selectVal == "Mensuel") {
                    $('#pricetotal')
                    $('#price').text('52,000 XAF').css("text-color", "blue");
                } else if (selectVal == "Annuel") {
                    var tot = price * 10
                    $('#price').text(tot);
                    $('#pricetotal').text(tot * total);
                    console.log(tot);
                } else {
                    $('#price').text('');
                }
            });

            //$("#fmaster").show(2000);

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

            // $('#paypal').click(function() {
            //     $('#fmaster').hide(1000);
            //     $('#fom').hide(1000);
            //     $('#fmomo').hide(1000);
            //     $('#fvisa').hide(1000);
            //     $('#fpaypal').show(1000);
            // });

            $('#om').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                $('#fom').show(1000);
            });

            // $('#momo').click(function() {
            //     $('#fmaster').hide(1000);
            //     $('#fpaypal').hide(1000);
            //     $('#fom').hide(1000);
            //     $('#fvisa').hide(1000);
            //     $('#fmomo').show(1000);
            // });

            $('#generate-link').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fom').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                checkout()
            });

            $('#wallet').click(function() {
                $('#fmaster').hide(1000);
                $('#fpaypal').hide(1000);
                $('#fom').hide(1000);
                $('#fmomo').hide(1000);
                $('#fvisa').hide(1000);
                payWithWallet()
            });


        });

        function payMaster(event) {
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

                    $.ajax({
                        url: urled,
                        type: "POST",
                        data: {
                            number: $('#masnumero').val(),
                            exp_month: parseInt($('#masmois_month').val().substring(5)),
                            exp_year: parseInt($('#masmois_month').val().substring(2,4)),
                            cvc: $('#mascvv').val(),
                            city: $('#masville').val(),
                            country: $('#maspays').val(),
                            phone: $('#phone').attr('value'),
                            postal_code: $('#maspost').val(),
                            state: $('#maspays').val(),
                            product_name: $('#name').attr('value'),
                            price_id: $('#price_id').attr('value'),
                            quantity: $('#qtity').attr('value'),
                            _token: token,
                        },
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
        };
        function checkout() {
            Swal.fire({
                title: "Voulez vous Generer le Lien de paiement ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OUI Payer",
                cancelButtonText: "Cancel",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {

                    let token = $('meta[name="csrf-token"]').attr('content');
                    const urled = "{{ route('payment.checkout', [] , false) }}";

                    $.ajax({
                        url: urled,
                        type: "POST",
                        data: {
                            _token: token,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>PATIENTEZ SVP,NOUS GENERONS LE LIEN DE PAIEMENT ...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response["status"] == "success") {
                                checkoutLink = response["url"];
                                Swal.fire({
                                    icon: response["status"],
                                    title: "Lien generé avec succès",
                                    html: `<a href="${response["url"]}" target="_blank">${response["url"]}</a>`,
                                    confirmButtonText: 'Copier <i class="fa fa-copy"></i>',
                                    timer: 20000,
                                    timerProgressBar: false,
                                    // willClose: () => {
                                    //     window.location.href = "{{ route('dashboard') }}";
                                    // }
                                }).then((r) => {
                                    if (r.isConfirmed) {
                                        copyCheckoutLink()
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
                            })
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
        };
        function payWithWallet() {
            Swal.fire({
                title: "Voulez vous Utiliser votre solde wallet pour payer l'abonnement ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "OUI Payer",
                cancelButtonText: "Cancel",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {

                    let token = $('meta[name="csrf-token"]').attr('content');
                    const urled = "{{ route('payment.wallet', [] , false) }}";

                    $.ajax({
                        url: urled,
                        type: "POST",
                        data: {
                            _token: token,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>PATIENTEZ SVP,NOUS GENERONS LE LIEN DE PAIEMENT ...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response["status"] == "success") {
                                checkoutLink = response["url"];
                                Swal.fire({
                                    icon: response["status"],
                                    title: "Paiement effectue avec success",
                                    // html: ``,
                                    // confirmButtonText: '',
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
                            })
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
        };

        function copyCheckoutLink() {
            console.log(checkoutLink);
            navigator.clipboard.writeText(checkoutLink);
            alert("Lien Copié");
        }
    </script>
@endsection

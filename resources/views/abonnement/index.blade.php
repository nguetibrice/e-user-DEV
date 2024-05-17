@extends('layouts.maindo')

@Section('titre')
    Bouquets
@endsection

@section('content')
    <div class="container ">
        <div class="d-flex  flex-wrap gap-4 justify-center">
            @foreach ($packages as $key=>$package)
                    <div class="card   mb-3" >
                        <a href="{{route('package.show',$key) }}" class="card-header text-center">
                            <span class="bg-primary badge rounded-pill  fs-4 text-white">{{ $package['product_name'] }}</span>
                        </a>
                        <div class="card-body text-dark">
                            <p class="card-text text-line-3">{{ $package['product_description'] }}</p>
                        </div>
                    </div>
            @endforeach
       </div>
    </div>
    {{-- <div class="font-sans text-gray-900 antialiased">
        <div class="container mx-auto">
            <div class="grid grid-cols-12 gap-x-8">
                <div class="col-span-4">
                    <div class="c-card block overflow-hidden rounded-lg bg-white shadow-md hover:shadow-xl">
                        <b class="p-4">CHOISIR UNE LANGUE</b>
                        @foreach ($packages as $package)
                            <div class="product p-2" id="{{ $package['product_id'] }}">
                                <div class="yem border-t">
                                    <button id="yemba"
                                        class="block divide-y-4 divide-slate-400/25 overflow-hidden rounded-lg border-2 bg-white shadow-md hover:shadow-xl">
                                        <span
                                            class="mt-4 mb-2 inline-block rounded-full bg-orange-200 px-4 py-2 text-xl font-semibold uppercase leading-none tracking-wide text-orange-800">
                                            {{ $package['product_name'] }}
                                        </span>
                                        <p class="inline-block text-sm font-bold">
                                            <i>
                                                {{ $package['product_description'] }}
                                            </i>
                                        </p>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="form" class="form-container col-span-8">
                    @foreach ($prix as $key => $price)
                        @foreach ($price['infdprice'] as $infoprix)
                            <form method="POST" action="{{ route('payment.page', [], false) }}"
                                class="form-{{ $loop->iteration }} {{ $key }} plan card w-[18rem] overflow-hidden">
                                @csrf
                                @if ($infoprix['up_to'] == '1')
                                    <figure class="h-[290px]">
                                        <img src="{{ asset('/image/individual.jpg') }}" class="card-img-top max-h-[100%]">
                                    </figure>
                                    <p class="mr-16 font-bold" name='bouquet'>
                                        <i>
                                            <input type="hidden" name="bouquet" value="individuel">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input type="hidden" name="price_id" value="{{ $price['idprice'] }}">
                                                    Plan de la langue <input type="hidden" name="langue"
                                                        value="{{ $price['name'] }}">{{ $price['name'] }}
                                                </h5>
                                                <p class="card-text">
                                                    Individuel
                                                </p>
                                            </div>
                                        </i>
                                    </p>
                                @elseif($infoprix['up_to'] >= '4' && $infoprix['up_to'] <= '10')
                                    <figure class="h-[290px]">
                                        <img src="{{ asset('/image/famille.jpg') }}" class="card-img-top max-h-[100%]">
                                    </figure>
                                    <p class="mr-16 font-bold" name='bouquet'>
                                        <i>
                                            <input type="hidden" name="bouquet" value="Familial">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input type="hidden" name="price_id" value="{{ $price['idprice'] }}">
                                                    Plan de la langue <input type="hidden" name="langue"
                                                        value="{{ $price['name'] }}">{{ $price['name'] }}
                                                </h5>
                                                <p class="card-text">
                                                    Famillial
                                                </p>
                                            </div>
                                        </i>
                                    </p>
                                @elseif($infoprix['up_to'] >= '10')
                                    <figure class="h-[290px]">
                                        <img src="{{ asset('/image/assos.jpg') }}" class="card-img-top max-h-[100%]">
                                    </figure>
                                    <p class="mr-16 font-bold" name='bouquet'>
                                        <i>
                                            <input type="hidden" name="bouquet" value="Association">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <input type="hidden" name="price_id" value="{{ $price['idprice'] }}">
                                                    Plan de la langue <input type="hidden" name="langue"
                                                        value="{{ $price['name'] }}">{{ $price['name'] }}
                                                </h5>
                                                <p class="card-text">
                                                    Association
                                                </p>
                                            </div>
                                        </i>
                                    </p>
                                @endif
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Prix : <b><i class="h-6 text-xl"><input type="hidden" name="prix"
                                                    value="{{ $infoprix['unit_amount'] }}">
                                                {{ $infoprix['unit_amount']/100 }}</i></b> XAF / Personne</p>
                                    </li>
                                    <li class="list-group-item">
                                        Maximum :<b><input type="hidden" name="place" value="{{ $infoprix['up_to'] }}">
                                            {{ $infoprix['up_to'] }}</b>
                                        @if ($infoprix['up_to'] > 1)
                                            places
                                        @else
                                            place
                                        @endif

                                        @if ($infoprix['up_to'] >= 10)
                                            <b>et plus</b>
                                        @endif
                                        </p>
                                    </li>
                                    <li class="list-group-item">
                                        Minimum : <b>1</b>
                                    </li>
                                    <hr>
                                </ul>
                                <div class="card-body">
                                    <input type="checkbox" id="check" class="h-6 w-6" name="choix" required />
                                    <label class="card-link">Choisir</label>
                                    <button type="submit" id="button" class="btn btn-primary button btn-full ml-4">
                                        Continuer
                                        <i class="fas fa-circle-right ml-2"></i>
                                    </button>

                                </div>
                            </form>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    --}}
    <style>
        .text-line-1, .text-line-2, .text-line-3 {
    overflow: hidden;
    line-height: 1em;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    }
    .text-line-1 {
    height: 1em;
    -webkit-line-clamp: 1;
    }
    .text-line-2 {
    height: 2em;
    -webkit-line-clamp: 2;
    }
    .text-line-3 {
    height: 8em;
    -webkit-line-clamp: 8;
    }
       .card{
        width: 18rem; 
        height: 15rem;
       }
       .card:hover{
        border-width: 1px;
        border-style: solid;
        border-color: #DEE2E6;
        border-width: 2px;
       }
       .card-header{
        cursor: pointer;
       }
       .content-wrapper{
        all: unset !important;
        padding-top: 1rem !important;  
       }
       .card-title{
        background-color: #4B49Ac;
       }
    </style> 
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>
       
    </script>
@endsection

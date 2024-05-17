@extends('layouts.maindo')

@Section('titre')
    Bouquets
@endsection
@section('content')
     <div class="container">
        <div class=" row presentation-language">
            <div class="title text-center">
                <h1 class="h1">{{$price["name"]}}</h1>
            </div>
            <div class="description text-center">
                <p>
                    {{$price["description"]}}
                </p>
            </div>
        </div>
        <div class="row presentation-offer">
            <div class="col-4 offer p-0">
                <form action="{{route('payment.page', [], false)}}" method="post">
                    @csrf
                    <div class=" head-offer-first ">
                            <span class="h6 text-white">plan individuel</span>
                    </div>
                    <div class="midle-offer-first text-white">
                        <span class="h1">{{$price["infdprice"][0]["unit_amount"]/100}}{{$price["currency"]}}</span>
                    </div>
                    <div class="body-offer p-3">
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                assistance illimité
                            </span>
                        </div>
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                            {{  $price["infdprice"][0]["up_to"] = 1 ? $price["infdprice"][0]["up_to"]." utilisateur max" : $price["infdprice"][0]["up_to"]." utilisateurs max"  }}
                            </span>
                        </div>
                         <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                sur 1 mois
                            </span>
                        </div>
                        <input hidden type="text" name="langue" value="{{$price['name']}}">
                        <input hidden type="number" name="place" value={{$price["infdprice"][0]["up_to"]}}>
                        <input hidden type="text" name="price" value="{{$price["infdprice"][0]["unit_amount"]}}">
                        <input hidden type="text" name="price_id" value="{{$price["idprice"]}}">
                        <input hidden type="text" name="bouquet" value="plan individuel">
                        <input hidden type="text" name="monnais" value="{{$price["currency"]}}">
                        <button class=" chosse-offer" type="submit">
                            choisir forfait
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-4 offer p-0">
                <form action="{{route('payment.page', [], false)}}" method="post">
                    @csrf
                    <div class=" head-offer-second ">
                            <span class="h6 text-white">plan de famille</span>
                    </div>
                    <div class="midle-offer-second text-white">
                        <span class="h1">{{$price["infdprice"][1]["unit_amount"]/100}}{{$price["currency"]}}</span>
                    </div>
                    <div class="body-offer p-3">
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                assistance illimité
                            </span>
                        </div>
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                {{  $price["infdprice"][1]["up_to"] = 1 ? $price["infdprice"][1]["up_to"]." utilisateur max" : $price["infdprice"][0]["up_to"]." utilisateurs max"  }}
                            </span>
                        </div>
                         <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                sur 1 mois
                            </span>
                        </div>
                            <input hidden type="text" name="langue" value="{{$price['name']}}">
                            <input hidden type="number" name="place" value={{$price["infdprice"][1]["up_to"]}}>
                            <input hidden type="text" name="price" value="{{$price["infdprice"][1]["unit_amount"]}}">
                            <input hidden type="text" name="price_id" value="{{$price["idprice"]}}">
                            <input hidden type="text" name="bouquet" value="plan de famille">
                            <input hidden type="text" name="monnais" value="{{$price["currency"]}}">
                        <button class=" chosse-offer" type="submit">
                            choisir forfait
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-4 offer p-0">
                <form action="{{route('payment.page', [], false)}}" method="post">
                    @csrf
                    <div class=" head-offer-third ">
                            <span class="h6 text-white">plan de communaute</span>
                    </div>
                    <div class="midle-offer-third text-white">
                        <span class="h1">{{$price["infdprice"][2]["unit_amount"]/100}}{{$price["currency"]}}</span>
                    </div>
                    <div class="body-offer p-3">
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                assistance illimité
                            </span>
                        </div>
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                utilisateurs illimité
                            </span>
                        </div>
                        <div class="assistance w-100">
                            <div class="contain-img">
                                <img src="{{asset('image/sign-check-icon.png')}}" alt="" srcset="">
                            </div>
                            <span class="ps-2">
                                sur 1 mois
                            </span>
                        </div>
                        <input hidden type="text" name="langue" value="{{$price['name']}}">
                            <input hidden type="number" name="place" value=100>
                            <input hidden type="text" name="price" value="{{$price["infdprice"][2]["unit_amount"]}}">
                            <input hidden type="text" name="price_id" value="{{$price["idprice"]}}">
                            <input hidden type="text" name="bouquet" value="plan de communaute">
                            <input hidden type="text" name="monnais" value="{{$price["currency"]}}">
                        <button class=" chosse-offer" type="submit">
                            choisir forfait
                        </button>
                    </div>
                </form>
            </div>
        </div>
     </div>

     <style>
        .img{
            height: auto;
            width: 100%;
        }
        .contain-img{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 15px;
        }
        .presentation-offer{
            padding-top: 2rem ;
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        .offer{
            cursor: pointer;
            height: 20rem;
            width: 12rem;
            background-color: #FFFFFF;
            box-shadow: 1px 0px 6px 1px rgba(0,0,0,0.73);
            -webkit-box-shadow: 1px 0px 6px 1px rgba(0,0,0,0.73);
            -moz-box-shadow: 1px 0px 6px 1px rgba(0,0,0,0.73);
        }
        .head-offer-first{
            cursor: pointer;
           display: flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            width:100%;
            background-color:#523D9D;

        }
        .midle-offer-first{

            display: flex;
            align-items: center;
            justify-content: center;
            height: 5rem;
            width:100%;
            background-color:#573ABA;
        }

         .head-offer-second{
           display: flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            width:100%;
            background-color:#719020;

        }
        .midle-offer-second{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 5rem;
            width:100%;
            background-color:#8fc305;
        }
.head-offer-third{
            cursor: pointer;
           display: flex;
            align-items: center;
            justify-content: center;
            height: 3rem;
            width:100%;
            background-color:#DD5F18;

        }
        .midle-offer-third{
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 5rem;
            width:100%;
            background-color:#ec6011;
        }

        .assistance{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .body-offer{
            display: flex;
            height: 12rem;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .chosse-offer{
            background-color: #eb6111;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
     </style>
@endsection

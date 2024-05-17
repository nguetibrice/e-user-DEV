<?php

namespace App\Http\Controllers;

use App\Services\ApiClient;
use App\Services\Contracts\ApiClientContract;
use Http;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    protected ApiClientContract $eUserApiClient;

    /**
     * @param ApiClientContract $eUserApiClient
     */
    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }
    //
    public function index()
    {
        $languages = $this->eUserApiClient->getLanguages("");
        // $prices = Http::get(env("E_USER_API")."/api/v1/prices");
        $colors = ['primary', 'danger', 'warning', 'info', 'success'];

        return view(
            "frontend.index",
            [
                "languages"=> $languages,
                'colors' => $colors
            ]
        );
    }

    public function dashboard(Request $request)
    {
        if ($request->payment_status != null) {
            switch ($request->payment_status) {
                case '1':
                    session()->flash('success', 'Paiement Effectué avec success!');
                    break;
                case '-1':
                    session()->flash('error', 'Echec De Paiement!');
                    break;

                default:
                    # code...
                    break;
            }
        }

        return view("dashboard")->with('success', 'Paiement Effectué avec success!');
    }
}

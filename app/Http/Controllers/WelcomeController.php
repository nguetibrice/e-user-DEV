<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
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
        $packages = $this->eUserApiClient->getAllPackages()['packages'];
        $payment_methods = $this->eUserApiClient->getPaymentMethods();
        // $prices = Http::get(env("E_USER_API")."/api/v1/prices");
        $colors = ['primary', 'danger', 'warning', 'info', 'success'];

        return view(
            "frontend.index",
            [
                "languages"=> $languages,
                'colors' => $colors,
                'payment_methods' => $payment_methods,
                'packages' => $packages
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

    public function quickPay(Request $request)
    {
        $request->validate([
            "firstname" => 'required',
            "lastname" => 'sometimes',
            "email" => 'required',
            "phone" => 'sometimes',
            'product_name' => 'required|string',
            'price_id' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'payment_method' => 'required',
            // 'redirect_url' => 'required',
            'birthday' => 'required|date',
        ]);
        try {
            $data = $request->all();
            unset($data["_token"]);
            $data["quantity"] = (int) $data["quantity"];
            if($data["payment_method"] == "MASTER" || $data["payment_method"] == "VISA") {
                $data["payment_method"] = "card";
            }

            $response = $this->eUserApiClient->quickPay($data);
            switch ($data["payment_method"]) {
                case 'card':
                    $url = $response["url"];
                    break;
                case 'OM':
                    $url = $response["payment_url"];
                    break;

                default:
                    # code...
                    break;
            }

            return response()->json([
                "status" => "success",
                "url" => $url
            ]);
        } catch (\Exception $th) {
            app()->get(Handler::class)->report($th);
            return response()->json([
                "status" => "fail",
                "message" => "Erreur Technique, veuillez reessayer plus tard"
            ], 400);
        }
    }
}

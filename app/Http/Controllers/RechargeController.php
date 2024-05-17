<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use App\Services\Contracts\ApiClientContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class RechargeController extends Controller
{

    protected ApiClientContract $eUserApiClient;

    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = $this->eUserApiClient->getPaymentMethods();
        $currencies = $this->eUserApiClient->getCurrencies();
        return view('recharge.index', [
            "payment_methods" => $payment_methods,
            "currencies" => $currencies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recharge(Request $request)
    {
        $request->validate([
            'currency' => 'required',
            'amount' => 'required',
            'payment_method' => 'required|array',
            'payment_method.type' => 'required|string|in:card,OM',
            'payment_method.card' => 'required_if:payment_method.type,card|array',
            'payment_method.card.number' => 'required_if:payment_method.type,card|string|min:16|max:16',
            'payment_method.card.exp_month' => 'required_if:payment_method.type,card|numeric|min:1|max:12',
            'payment_method.card.exp_year' => 'required_if:payment_method.type,card|numeric|min:1',
            'payment_method.card.cvc' => 'required_if:payment_method.type,card|numeric|min:1',
            'address' => 'required|array',
            'address.country' => 'required|string',
            'address.city' => 'required|string',
            'address.phone' => 'required|string',
            'address.postal_code' => 'required|string',
            'address.state' => 'required|string',
            'redirect_url' => 'required_if:payment_method.type,OM',
        ]);

        $data = $request->all();
        $data["address"]["line1"] = $data["address"]["phone"];
        $data["address"]["line2"] = $data["address"]["phone"];
        $token = session('auth_token');
        try {
            if (is_array($token)) {
                $token = $token["value"];
            }
            $response = $this->eUserApiClient->rechargeWallet($token, $data);
            if (isset($response["payment_url"]) &&
                $response["payment_url"] != ""
            ) {
                return redirect()->away($response["payment_url"]);
            }
            if (isset($response["balance"])) {
                session()->put('wallet_balance', $response['balance']);
            }
            return response()->json([
                "status" => "success",
                "balance" => $response["balance"]
            ]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return response()->json([
                'error' => Lang::get('Erreur de paiement, recommencer plus tard'),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stacktrace' => $e->getTrace()
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'target' => 'required',
            'amount' => 'required'
        ]);

        $token = session('auth_token');
        $data = $request->only(["target", "amount"]);
        try {
            $response = $this->eUserApiClient->walletTrasfer($token, $data);
            response()->json($response);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return response()->json([
                'error' => Lang::get('Erreur lors du transfer, recommencer plus tard'),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stacktrace' => $e->getTrace()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

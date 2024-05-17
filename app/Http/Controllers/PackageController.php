<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use App\Traits\PaginationTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    use PaginationTrait;

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
    public function getPackage()
    {
        $packages = $this->eUserApiClient->getAllPackages()['packages'];
        return $packages;
    }
    public function listPackageResources()
    {
        try {
            $packages = $this->getPackage();
            return view('abonnement.index', compact('packages'));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("Erreur, recommencer ce procédé plus tard"));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendInfosPaymentPage(Request $request)
    {
        $infos = ([
            'langue' => $request->input('langue'),
            'bouquet' => $request->input('bouquet'),
            'price' => $request->input('price')/100,
            'monnais' => $request->input('monnais'),
            'place' => $request->input('place'),
            'price_id' => $request->input('price_id'),
        ]);
        session()->put('package', $infos);
        return redirect()->route("payment.page.display");
    }

    public function displayPayment()
    {
        $payment_methods = $this->eUserApiClient->getPaymentMethods();
        return view('paiement.index', ["infos" => session("package"),"payment_methods" => $payment_methods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function paiementCardStripe(Request $request): JsonResponse
    {
        $request->validate([
            'product_name' => 'required|string',
            'price_id' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'number' => 'required|string|min:16|max:16',
            'exp_month' => 'required|numeric|min:1|max:12',
            'exp_year' => 'required|numeric|min:1',
            'cvc' => 'required|numeric|min:1',
            'city' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'postal_code' => 'required|string',
            'state' => 'required|string',
        ]);

        $exp_month = (int) $request->input('exp_month');
        $exp_year = (int) $request->input('exp_year');
        $cvc = (int) $request->input('cvc');
        $quantity = (int) $request->input('quantity');

        $number = $request->input('number');
        $city = $request->input('city');
        $country = $request->input('country');
        $phone = $request->input('phone');
        $postal_code = $request->input('postal_code');
        $state = $request->input('state');

        $product_name = $request->input('product_name');
        $price_id =  $request->input('price_id');


        $payment_method = [
            "type" => "card",
            "card" => [
                "number" => $number,
                "exp_month" => $exp_month,
                "exp_year" => $exp_year,
                "cvc" => $cvc
            ]
        ];

        $address = [
            "city" => $city,
            "country" => $country,
            "line1" => $phone,
            "line2" => $phone,
            "postal_code" => $postal_code,
            "state" => $state
        ];

        $token = session('auth_token');

        $data = [
            "product_name" => $product_name,
            "price_id" => $price_id,
            "quantity" => $quantity,
            "payment_method" => $payment_method,
            "address" => $address,
        ];
        try {
            $response = $this->eUserApiClient->makeSubscriptionPayment($token, $data);
            return response()->json($response);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return response()->json([
                'error' => Lang::get('Erreur de paiement, recommencer plus tard'),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'stacktrace' => $e->getTrace()
            ], 200);
        }
    }

    /**
     * Create Checkout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request): JsonResponse
    {
        $infos = session()->get("package");
        $token = session('auth_token');

        $data = [
            "product_name" => $infos["price_id"],
            "price_id" => $infos["price_id"],
            "quantity" => $infos["place"],
            "redirect_url" => env("APP_URL")
        ];
        try {
            $url = $this->eUserApiClient->createCheckout($token["value"], $data);
            return response()->json([
                "status" => "success",
                "url" => $url
            ]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return response()->json([
                'status' => 'error',
                'error' => Lang::get('Erreur de paiement, recommencer plus tard')
            ], 400);
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubscriptions(Request $request)
    {
        $token = session('auth_token');

        try {
            $user = $this->eUserApiClient->currentConnectedUser($token)['user'];
            $response = $this->eUserApiClient->getSubscriptions(
                $token,
                $user['id'],
                $request->has('onlySponsored')
            );
            return response()->json($response['data']);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', $e->getMessage());
        }
    }

    public function paymentOrangeMoney(Request $request): RedirectResponse
    {
        $request->validate([
            'city' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'postal_code' => 'required|string',
            'currency' => 'required|string',
        ]);

        try {
            $city = $request->input('city');
            $country = $request->input('country');
            $phone = $request->input('phone');
            $postal_code = $request->input('postal_code');
            $currency = $request->input('currency');
            $infos = session()->get('package');
            if ($infos == null) {
                return response()->json(['error' => Lang::get('Information inconnu')]);
            }
            $payment_method = [
                "type" => "OM",
            ];

            $address = [
                "city" => $city,
                "country" => $country,
                "line1" => $phone,
                "line2" => $phone,
                "postal_code" => $postal_code,
                "state" => $city
            ];

            $token = session('auth_token');

            $data = [
                "product_name" => $infos["langue"],
                "price_id" => $infos["price_id"],
                "quantity" => $infos["place"],
                "payment_method" => $payment_method,
                "address" => $address,
                "currency" => $currency,
                "redirect_url" => env("APP_URL")
            ];

            $response = $this->eUserApiClient->makeSubscriptionPayment($token, $data);
            if (isset($response["data"]) &&
                isset($response["data"]["payment_url"]) &&
                $response["data"]["payment_url"] != ""
            ) {
                return redirect()->away($response["data"]["payment_url"]);
            } else {
                Log::error("SOMETHING_WENT_WRONG_ORANGE_MONEY:", $response);
                return back()->with('error', Lang::get('Erreur de paiement, recommencer plus tard'));
            }
        } catch (\Throwable $th) {
            app()->get(Handler::class)->report($th);
            return back()->with('error', Lang::get('Erreur de paiement, recommencer plus tard'));
        }
    }

    public function getPrice($keys)
    {
        $price = null;
        $package = null;

        $packages = $this->getPackage();
        foreach ($packages as $key => $value) {
            if ($key == $keys) {
                $package = $value;
                break;
            }
        }
        if (isset($package['recurring_intervals']['year'])) {
            $price = [
                "periode" => $package['recurring_intervals']['year'],
                "product_id" => $package['product_id'],
                "name" => $package['product_name'],
                "description" => $package['product_description'],
                "currency" => $package['currency'],
                "idprice" => $package['recurring_intervals']['year']['price_id'],
                "infdprice" => $package['recurring_intervals']['year']['tiers']
            ];
        } elseif (isset($package['recurring_intervals']['month'])) {
            $price = [
                "periode" => $package['recurring_intervals']['month'],
                "product_id" => $package['product_id'],
                "name" => $package['product_name'],
                "description" => $package['product_description'],
                "currency" => $package['currency'],
                "idprice" => $package['recurring_intervals']['month']['price_id'],
                "infdprice" => $package['recurring_intervals']['month']['tiers']
            ];
        } elseif (isset($package['recurring_intervals']['week'])) {
            $price = [
                "periode" => $package['recurring_intervals']['week'],
                "product_id" => $package['product_id'],
                "name" => $package['product_name'],
                "description" => $package['product_description'],
                "currency" => $package['currency'],
                "idprice" => $package['recurring_intervals']['week']['price_id'],
                "infdprice" => $package['recurring_intervals']['week']['tiers']
            ];
        } elseif (isset($package['recurring_intervals']['day'])) {
            $price = [
                "periode" => $package['recurring_intervals']['day'],
                "product_id" => $package['product_id'],
                "name" => $package['product_name'],
                "description" => $package['product_description'],
                "currency" => $package['currency'],
                "idprice" => $package['recurring_intervals']['day']['price_id'],
                "infdprice" => $package['recurring_intervals']['day']['tiers']
            ];
        } else {
            $error =  new \Exception('Package has no price: ' . json_encode($package), 500);
            app()->get(Handler::class)->report($error);
            unset($packages[$package]);
        }
        return $price;
    }

    public function show($keys)
    {
        $price = $this->getPrice($keys);
        return view('abonnement.show', compact('price'));
    }
}

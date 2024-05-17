<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Services\Contracts\ApiClientContract;

class AuthController extends Controller
{
    protected ApiClientContract $eUserApiClient;

    /**
     * @param ApiClientContract $eUserApiClient
     */
    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }

    /**
     * Handle a login attempt
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate(['alias' => 'required|string', 'password' => 'required|string']);
        $userLoginInfo = [
            'alias' => $request->input('alias'),
            'ip' => $request->ip(),
            'password' => $request->input('password')
        ];

        try {
            $response = $this->eUserApiClient->openSession($userLoginInfo);
            if (isset($response["data"]["type"]) && $response["data"]["type"] == "redirect") {
                return redirect()->to('/code')->with('success', $response['data']['message']);
            }
            $token = $response['data']['token'];
            session()->put('auth_token', $token["token"]);
            // session()->put('wallet_balance', $response['data']['wallet_balance']);
            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("L'alias ou le mot de passe ne correspondent pas"));
        }
    }

    /**
     * Logs out the currently authenticated user
     */
    public function logout(): RedirectResponse
    {
        $token = session()->get('auth_token');
        try {
            $this->eUserApiClient->closeSession($token);
            session()->forget('auth_token');
            return redirect()->route('login');
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("Erreur, recommencer ce procédé plus tard"));
        }
    }
}

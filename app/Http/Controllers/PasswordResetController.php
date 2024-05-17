<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;

class PasswordResetController extends Controller
{
    protected ApiClientContract $eUserApiClient;

    /**
     * @param ApiClientContract $eUserApiClient
     */
    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }

    public function showCodeRequestForm()
    {
        return view('password.forgot-password');
    }

    public function sendResetCodeEmail(Request $request)
    {
        try {
            $data = $request->validate(['email' => 'required|email']);
            $data['reset-password-url'] = route('password.reset');
            $this->eUserApiClient->requestPasswordReset($data);
            session()->flash(
                'success',
                "Un lien de réinitialisation du mot de passe a été envoyé à l'adresse fournie"
            );
            return view('password.forgot-password');
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', "Erreur, veuillez réessayer plus tard.");
        }
    }

    public function showResetForm(Request $request)
    {
        $data = $request->validate(['email' => 'required', 'token' => 'required']);
        return view('password.reset-password', $data);
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|confirmed'
            ]);
            $this->eUserApiClient->resetPassword(
                $request->only('email', 'password', 'password_confirmation', 'token')
            );
            session()->forget('auth_token');
            return redirect()->route('login')->with('status', Lang::get('Mot de passe mis à jour'));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', "Erreur, veuillez réessayer plus tard.");
        }
    }
}

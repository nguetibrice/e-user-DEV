<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;

class ProfileController extends Controller
{
    protected ApiClientContract $eUserApiClient;

    /**
     * @param ApiClientContract $eUserApiClient
     */
    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }

    public function showAccountSettings()
    {
        $token = session('auth_token');
        try {
            $user = $this->eUserApiClient->currentConnectedUser($token)['user'];
            return view('profil.parametres', compact('user'));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("Une erreur s'est produite, recommencer plus tard"));
        }
    }

    public function getCurrentUser()
    {
        $token = session('auth_token');
        try {
            $user = $this->eUserApiClient->getCurrentUser($token)['user'];
            return response()->json($user);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("Une erreur s'est produite, recommencer plus tard"));
        }
    }

    public function getUser($id)
    {
        $token = session('auth_token');
        try {
            $user = $this->eUserApiClient->getUser($id, $token)['user'];
            return response()->json($user);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', "Une erreur s'est produite, recommencer plus tard");
        }
    }

    /**
     * Update user profile data of the authenticated user.
     */
    public function updateProfile(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name' => 'sometimes|string|min:4|max:24',
            'last_name' => 'sometimes|string|min:4|max:24',
            'email' => ['sometimes', 'string', 'email', 'max:255'],
            'phone' => 'sometimes|string',
        ]);

        $token = session('auth_token');

        try {
            $this->eUserApiClient->updateProfile($data, $token['value']);
            session()->flash('message', Lang::get('Mise à jour du profil réussi'));
            return response()->json(['success', Lang::get('Mise à jour du profil réussi')]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            session()->flash('error', Lang::get("Erreur, recommencer ce procédé plus tard"));
            return response()->json(['error', Lang::get("erreur, recommencer ce procédé plus tard")]);
        }
    }

    /**
     * Update user password of the authenticated user.
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $data = $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password|min:8'
        ]);

        $token = session('auth_token');

        try {
            $this->eUserApiClient->updatePassword($data['password'], $token['value']);
            session()->flash('message', Lang::get('Mise à jour du mot de passe réussi'));
            return response()->json(['success', Lang::get('Mise à jour du mot de passe réussi')]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            session()->flash('error', Lang::get("Erreur, recommencer plus tard"));
            return response()->json(['error', Lang::get("Erreur, recommencer plus tard")]);
        }
    }

    public function updateGuardian(Request $request)
    {
        $data = $request->validate([
            'guardian' => 'required|min:4',
        ]);
        $token = session('auth_token');
        try {
            $this->eUserApiClient->updateGuardian($data['guardian'], $token['value']);
            session()->flash('message', Lang::get('Mise à jour du tuteur réussi'));
            return response()->json(['success', Lang::get('Mise à jour du tuteur réussi')]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            session()->flash('error', Lang::get("Erreur, recommencer plus tard"));
            return response()->json(['error', Lang::get("Erreur, recommencer plus tard")]);
        }
    }


    /**
     * Delete the authenticated user.
     */
    public function deleteUser(): JsonResponse
    {
        $token = session('auth_token');

        try {
            $this->eUserApiClient->destroyUser($token['value']);
            session()->forget('auth_token');
            return response()->json(['success', Lang::get('Votre compte a été supprimé')]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            session()->flash('error', Lang::get("Erreur, recommencer ce procédé plus tard"));
            return response()->json(['error', Lang::get("Une erreur s'est produite, recommencer plus tard")]);
        }
    }
}

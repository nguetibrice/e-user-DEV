<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Fluent;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'birthday' => 'sometimes|date',
            'first_name' => 'required|string|min:4|max:24',
            'last_name' => 'required|string|min:4|max:24',
            'phone' => 'sometimes|string',
            'alias' => 'required|string|min:4|max:24',
            'email' => 'required|email',
            'cip' => 'sometimes',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@%-+_!.,@#$^&?%éè]).+$/'
            ],
            'guardian' => [
                'string',
                Rule::requiredIf($this->checkAge($request->birthday))
            ],
        ]);
        $user['ip'] = $request->ip();
        try {
            $response = $this->eUserApiClient->createUser($user);
            $token = $response["data"]["token"];
            session(['auth_token' => $token]);
            return redirect()->to('/code')->with('success', $response['data']['message']);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with(
                'error',
                Lang::get($e->getMessage())
            )->withInput();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function actveAccount(Request $request)
    {
        $token = session('auth_token');
        $data = [
            'pin' => $request->input('code')
        ];
        try {
            $message = $this->eUserApiClient->activeAccount($data, $token);
            /** Supprimer les données de la séssion */
            session()->forget('auth_token');
            return redirect()->route('login')->with('success', $message);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with('error', Lang::get("Problème d'activation du compte, veuillez prendre plus tard"));
        }
    }

    private function checkAge($birthday)
    {
        if ($birthday) {
            $date1=date_create(date("Y-m-d"));
            $date2=date_create($birthday);
            $diff=date_diff($date1, $date2);
            return $diff->y >= 18;
        }
        return false;
    }

    public function completeProfile(Request $request)
    {
        $request->validate([
            "cip" => "required"
        ]);
        try {
            $user = $this->eUserApiClient->getUserFromCip($request->cip)["user"];
            if ($user["status"] != 0) {
                return redirect()->route("login")->with('error', Lang::get("Veillez vous connecter a votre compte pour terminer votre action"));
            }
            $dateTime = new DateTime($user["birthday"]);

            // Format the date using the desired format string
            $formattedDate = $dateTime->format('Y-m-d');

            $user["birthday"] = $formattedDate; // Output: 2024-04-24
            return view('auth.complete-profile', compact("user"));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return redirect()->route("home")->with('error', Lang::get("Utilisateur Introuvable, veillez reessayer plus tard"));
        }

    }
}

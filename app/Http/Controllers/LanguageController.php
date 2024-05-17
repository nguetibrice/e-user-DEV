<?php

namespace App\Http\Controllers;

use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;

class LanguageController extends Controller
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
     * Display a listing of the languages
     */
    public function index()
    {
        $token = session('auth_token');
        $languages = $this->eUserApiClient->getLanguages($token['value']);
        return view('admin.languages', ['languages' => $languages]);
    }

    /**
     * Show the form for creating a new language.
     */
    public function create()
    {
        return view('admin.languages.create-language');
    }

    /**
     * Store a newly created language in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|size:4',
            'linguist' => 'required|string|size:4',
            'description' => 'required|string',
            'status' => 'required|integer'
        ]);

        $token = session('auth_token');

        try {
            $this->eUserApiClient->createLanguage($input, $token['value']);
            return redirect()->route('languages')->with('success', Lang::get('Langue créée.'));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with(
                'error',
                Lang::get("Nous n'avons pas pu créer la langue en raison d'une erreur, veuillez recommencer.")
            );
        }
    }

    /**
     * Show the form for editing the specified language.
     */
    public function edit(string $id)
    {
        $language = $this->eUserApiClient->getLanguage($id);
        return view('admin.languages.update-language', ['language' => $language]);
    }

    /**
     * Update the specified language in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->validate([
            'code' => 'sometimes|string|size:4',
            'name' => 'sometimes|string',
            'linguist' => 'required|string|size:4',
            'description' => 'sometimes|string',
            'status' => 'sometimes|integer'
        ]);

        $token = session('auth_token');

        try {
            $this->eUserApiClient->updateLanguage($input, $id, $token['value']);
            return redirect()->route('languages')->with('success', Lang::get('Langue mise à jour.'));
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return back()->with(
                'error',
                Lang::get("Nous n'avons pas pu mettre à jour la langue en raison d'une erreur, veuillez recommencez.")
            );
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function delete(string $id)
    {
        $token = session('auth_token');

        try {
            $this->eUserApiClient->deleteLanguage($id, $token['value']);
            return response()->json(['success', Lang::get("Langue supprimée")]);
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return response()->json([
                'error',
                Lang::get("Nous n'avons pas pu supprimer cette langue, veuillez recommencer.")
            ]);
        }
    }
}

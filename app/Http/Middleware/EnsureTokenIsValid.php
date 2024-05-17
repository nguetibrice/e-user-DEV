<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\Handler;
use App\Services\ApiClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;

class EnsureTokenIsValid
{
    protected ApiClientContract $eUserApiClient;

    /**
     * Undocumented function
     *
     * @param ApiClientContract $eUserApiClient
     */
    public function __construct(ApiClient $eUserApiClient)
    {
        $this->eUserApiClient = $eUserApiClient;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = session()->get('auth_token');

        try {
            if ($token) {
                $this->eUserApiClient->ensureTokenIsValid($token);
                return $next($request);
            } else {
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            app()->get(Handler::class)->report($e);
            return redirect()->route('login')->with('error', Lang::get($e->getMessage()));
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Response;
use App\Exceptions\ApiException;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Lang;
use App\Services\Contracts\ApiClientContract;

class ApiClient implements ApiClientContract
{
    protected Factory $client;

    protected string $url;

    public function __construct(Factory $client)
    {
        $this->client = $client;
        $this->url = env('E_USER_API');
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param array $userLoginInfo
     * @return array
     */
    public function openSession($userLoginInfo): array
    {
        $requestUrl = $this->url . "/api/v1/user/login";
        $response = $this->getClient()->post($requestUrl, $userLoginInfo);
        $user = $this->handleResponse($response, $requestUrl, $userLoginInfo);
        return $user;
    }

    /**
     * @param string $token
     * @return array
     */
    public function closeSession($token): array
    {
        $requestUrl = $this->url . "/api/v1/user/logout";
        $response = $this->getClient()->withToken($token["value"])->post($requestUrl);
        $user = $this->handleResponse($response, $requestUrl);
        return $user;
    }

    /**
     * @return array
     */
    public function getAllPackages(): array
    {
        $requestUrl = $this->url . '/api/v1/subscription/packages';
        $openPack = $this->getClient()->get($requestUrl);
        $response = $this->handleResponse($openPack, $requestUrl);
        return $response['data']['packages'];
    }

    /**
     * @param string $token
     * @param array $data
     * @return array
     */
    public function makeSubscriptionPayment($token, $data)
    {
        $requestUrl = $this->url . '/api/v1/subscription/create';
        $payResponse = $this->getClient()->withToken($token['value'])->post($requestUrl, $data);
        $response = $this->handleResponse($payResponse, $requestUrl, $data);
        return $response;
    }

    public function currentConnectedUser($token)
    {
        $requestUrl = $this->url . '/api/v1/user/profile';
        $payPack =  $this->getClient()->withToken($token['value'])->get($requestUrl);
        $response = $this->handleResponse($payPack, $requestUrl);
        return $response['data'];
    }

    /**
     * Get profile data of the currently logged-in user
     *
     * @param string $token
     * @return array
     */
    public function getCurrentUser($token): array
    {
        $requestUrl = $this->url . "/api/v1/user/profile";
        $response = $this->getClient()->withToken($token['value'])->get($requestUrl);
        $user = $this->handleResponse($response, $requestUrl)['data'];
        return $user;
    }

    /**
     * @param array $data
     * @param string $token
     */
    public function updateProfile($data, $token)
    {
        $requestUrl = $this->url . '/api/v1/user/profile';
        $reponse =  $this->getClient()->withToken($token)->patch($requestUrl, $data);
        return $this->handleResponse($reponse, $requestUrl, $data);
    }

    /**
     * @param string $password
     * @param string $token
     */
    public function updatePassword($password, $token)
    {
        $requestUrl = $this->url . '/api/v1/user/password';
        $user = $this->getClient()->withToken($token)->patch($requestUrl, ['password' => $password]);
        return $this->handleResponse($user, $requestUrl);
    }

    /**
     * @param string $password
     * @param string $token
     */
    public function updateGuardian($guardian, $token)
    {
        $requestUrl = $this->url . '/api/v1/user/guardian';
        $user = $this->getClient()->withToken($token)->put($requestUrl, ['guardian' => $guardian]);
        return $this->handleResponse($user, $requestUrl);
    }

    /**
     * @param string $token
     */
    public function destroyUser($token)
    {
        $requestUrl = $this->url . '/api/v1/user';
        $response = $this->getClient()->withToken($token)->delete($requestUrl);
        return $this->handleResponse($response, $requestUrl);
    }

    /**
     * @param array $newUser
     * @return array
     */
    public function createUser($newUser): array
    {
        $requestUrl = $this->url . "/api/v1/user/register";
        $userCreated = $this->getClient()->post($requestUrl, $newUser);
        $response = $this->handleResponse($userCreated, $requestUrl);
        return $response;
    }

    /**
     * Get the profile data of a user
     *
     * @param string $cip
     * @param string $token
     * @return array
     */
    public function getUser($cip, $token): array
    {
        $requestUrl = $this->url . "/api/v1/user/$cip/profile";
        $response = $this->getClient()->withToken($token['value'])->get($requestUrl);
        $user = $this->handleResponse($response, $requestUrl)['data'];
        return $user;
    }

    /**
     * @param array $token
     * @return void
     */
    public function ensureTokenIsValid($token)
    {
        $requestUrl = $this->url . '/api/v1/user/is/connect';
        $response = $this->getClient()->withToken($token['value'])->get($requestUrl);
        $this->handleResponse($response, $requestUrl);
        return 0;
    }

    /**
     * @return string
     */
    public function requestPasswordReset(array $credentials)
    {
        $requestUrl = $this->url . '/api/v1/user/forgot-password';
        $status = $this->getClient()->post($requestUrl, $credentials);
        $response = $this->handleResponse($status, $requestUrl, $credentials);
        return $response["data"]["message"];
    }

    /**
     * @return string
     */
    public function resetPassword(array $credentials)
    {
        $requestUrl = $this->url . '/api/v1/user/reset-password';
        $status = $this->getClient()->post($requestUrl, $credentials);
        $response = $this->handleResponse($status, $requestUrl, $credentials);
        return $response["data"]["message"];
    }

    /**
     * @param array $data
     * @param array $token
     * @return void
     */
    public function activeAccount($data, $token)
    {
        $requestUrl = $this->url . '/api/v1/user/activate-account';
        $pin = $this->getClient()->withToken($token['value'])->post($requestUrl, $data);
        $response = $this->handleResponse($pin, $requestUrl, $data);
        return $response["data"]["message"];
    }

    /**
     * @param array $data
     * @param array $token
     * @return void
     */
    public function validatedCode($data, $token)
    {
        $requestUrl = $this->url . '/api/v1/user/valide-code';
        $pin = $this->getClient()->withToken($token['value'])->post($requestUrl, $data);
        $response = $this->handleResponse($pin, $requestUrl, $data);
        return $response;
    }

    /**
     * @param array $token
     * @return void
     */
    public function showAllPackageToPay(array $token)
    {
        $requestUrl = $this->url . '/api/v1/customers/visible/all';
        $payPack = $this->getClient()->withToken($token['value'])->get($requestUrl);
        $response = $this->handleResponse($payPack, $requestUrl);
        return $response;
    }

    public function getSubscriptions(array $token, int $user, bool $onlySponsored = false)
    {
        $requestUrl = $this->url . '/api/v1/users/' . $user . '/subscriptions';
        if ($onlySponsored == true) {
            $requestUrl .= "?onlySponsored";
        }
        $response = $this->getClient()->withToken($token['value'])->get($requestUrl);
        return $this->handleResponse($response, $requestUrl);
    }

    public function getLanguages(string $token)
    {
        $requestUrl = $this->url . '/api/v1/languages';
        $response = $this->getClient()->withToken($token)->get($requestUrl);
        return $this->handleResponse($response, $requestUrl)['data']['languages'];
    }

    public function getPaymentMethods()
    {
        $requestUrl = $this->url . '/api/v1/payment-methods';
        $response = $this->getClient()->get($requestUrl);
        return $this->handleResponse($response, $requestUrl)['data']['payment_methods'];
    }

    public function getLanguage(string $id)
    {
        $requestUrl = $this->url . '/api/v1/languages/' . $id;
        $response = $this->getClient()->get($requestUrl);
        return $this->handleResponse($response, $requestUrl)['data']['language'];
    }

    public function createLanguage(array $data, string $token)
    {
        $requestUrl = $this->url . '/api/v1/languages';
        $response = $this->getClient()->withToken($token)->post($requestUrl, $data);
        return $this->handleResponse($response, $requestUrl, $data)['data']['language'];
    }

    public function updateLanguage(array $data, string $id, string $token)
    {
        $requestUrl = $this->url . '/api/v1/languages/' . $id;
        $response = $this->getClient()->withToken($token)->put($requestUrl, $data);
        return $this->handleResponse($response, $requestUrl, $data)['data']['language'];
    }

    public function deleteLanguage(string $id, string $token)
    {
        $requestUrl = $this->url . '/api/v1/languages/' . $id;
        $response = $this->getClient()->withToken($token)->delete($requestUrl);
        return $this->handleResponse($response, $requestUrl)['data']['message'];
    }

    public function createCheckout(string $token, array $data)
    {
        $requestUrl = $this->url . '/api/v1/subscription/checkout';
        $response = $this->getClient()->withToken($token)->post($requestUrl, $data);
        return $this->handleResponse($response, $requestUrl)['data']['url'];
    }

    /**
     * @param Response $response
     * @param string $requestUrl
     * @return array
     * @throws \Exception
     */
    protected function handleResponse($response, $requestUrl, $payload = null): array
    {
        $data = $response->json();
        $status = $data['status'] ?? 'error';
        if ($response["status"] != "success" || $status === 'error') {
            $message = $data['message'] ?? $response['reason'];
            // $message = $data['message'] ?? $response->reason();
            $apiException = new ApiException(Lang::get($message));
            $apiException->setRequestUrl($requestUrl)->setResponse($response);
            if (isset($payload)) {
                $apiException->setRequestPayload($payload);
            }
            throw $apiException;
        }

        if ($response == null) {
            $message = $data['message'] ?? $response->reason();
            $apiException = new ApiException(Lang::get($message));
            $apiException->setRequestUrl($requestUrl)->setResponse($response);
            if (isset($payload)) {
                $apiException->setRequestPayload($payload);
            }

            throw $apiException;
        }

        return $data;
    }
}

<?php

namespace App\Services\Contracts;

interface ApiClientContract
{
    /**
     * @return array
     */
    public function getAllPackages(): array;

    /**
     * @param string $token
     * @param array $data
     * @return void
     */
    public function makeSubscriptionPayment(string $token, array $data);

    /**
     * @param array $userLoginInfo
     * @return array
     */
    public function openSession(array $userLoginInfo): array;

    /**
     * @param string $token
     * @return array
     */
    public function closeSession(string $token): array;

    /**
     * @param string $token
     */
    public function currentConnectedUser(string $token);

    /**
     * Get profile data of the currently logged-in user
     *
     * @param string $token
     * @return array
     */
    public function getCurrentUser(string $token): array;

    /**
     * @param array $user
     * @param string $token
     */
    public function updateProfile(array $data, string $token);

    /**
     *
     * @param string $password
     * @param string $token
     */
    public function updatePassword(string $password, string $token);

    /**
     *
     * @param string $token
     */
    public function destroyUser(string $token);

    /**
     *
     * @param array $user
     * @return array
     */
    public function createUser(array $user): array;

    /**
     * Get the profile data of a user
     *
     * @param string $cip
     * @param string $token
     * @return array
     */
    public function getUser(string $cip, string $token): array;

    /**
     * Get user from cip
     *
     * @param string $cip
     * @return array
     */
    public function getUserFromCip($cip): array;
    /**
     *
     * @param array $token
     * @return void
     */
    public function ensureTokenIsValid(array $token);

    /**
     * @return string
     */
    public function requestPasswordReset(array $credentials);

    /**
     * @return string
     */
    public function resetPassword(array $credentials);

    /**
     *
     * @param array $data
     * @param array $token
     * @return void
     */
    public function activeAccount(array $data, array $token);

    /**
     *
     * @param array $data
     * @param array $token
     * @return void
     */
    public function validatedCode(array $data, array $token);

    /**
     *
     * @param array $token
     * @return void
     */
    public function showAllPackageToPay(array $token);

    /**
     * @return array
     */
    public function getSubscriptions(array $token, int $user, bool $onlySponsored = false);

    /**
     * @return array
     */
    public function getLanguages(string $token);

    /**
     * @return array
     */
    public function getPaymentMethods();

    /**
     * @return array
     */
    public function getLanguage(string $id);

    /**
     * Create a new language.
     */
    public function createLanguage(array $data, string $token);

    /**
     * Update the specified language.
     */
    public function updateLanguage(array $data, string $id, string $token);

    /**
     * Delete the specified language.
     */
    public function deleteLanguage(string $id, string $token);

    /**
     * Delete the specified language.
     */
    public function createCheckout(string $token, array $data);

    /**
     * Delete the specified language.
     */
    public function rechargeWallet(string $token, array $data);

    /**
     * Delete the specified language.
     */
    public function walletTrasfer(string $token, array $data);

    /**
     * Delete the specified language.
     */
    public function paySubscriptionWithWallet(string $token, array $data);

    /**
     * quickpay
     */
    public function quickPay(array $data);

    /**
     * Delete the specified language.
     */
    public function getCurrencies();


}

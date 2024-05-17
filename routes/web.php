<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RechargeController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    // dd('dss');
    return view('auth.register');
})->name('register');

Route::get('/apprenant', function () {
    return view('code.register');
})->name('register-with-code');

Route::get('/code', function () {
    return view('code.index');
});

Route::controller(PasswordResetController::class)->group(function () {
    Route::get('/forgot-password', 'showCodeRequestForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetCodeEmail');
    Route::get('/reset-password', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'store');
    Route::post('/Account/actived', 'actveAccount')->name('account.active');
});

// Route::get('/itoweer', [BouquetController::class, 'index']);

Route::middleware('fredAuthVerify')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [WelcomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/create/apprenant/tuteur', function () {
        return view('apprenant.create_at');
    });
    Route::controller(RechargeController::class)->group(function () {
        Route::get('/recharge', 'index')->name('recharge.view');
    });
    Route::controller(PackageController::class)->group(function () {
        Route::post('/paiement/confirme', 'paiementCardStripe')->name('payment.stripe');
        Route::post('/paiement/orange-money', 'paymentOrangeMoney')->name('payment.om');
        Route::get('/customer/subscriptions', 'getSubscriptions')->name('subscriptions');
        Route::get('/user/abonnement', 'listPackageResources')->name('package.lang');
        Route::get('/user/getabonnement/{id}', 'show')->name('package.show');
        Route::post('/package/pay', 'sendInfosPaymentPage')->name('payment.page');
        Route::post('/package/checkout', 'checkout')->name('payment.checkout');
        Route::get('/package/payment', 'displayPayment')->name('payment.page.display');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/config/backend/all_customers', 'customersShow')->name('all.customers_details');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/settings', 'showAccountSettings')->name('account_settings');
        Route::get('/backend/user', 'getCurrentUser')->name('auth.current_user');
        Route::get('/backend/user/{id}', 'getUser')->name('auth.get_user');
        Route::patch('/user/profile', 'updateProfile')->name('user_profile_update');
        Route::patch('/user/password', 'updatePassword')->name('user_pasword_update');
        Route::put('/user/guardian', 'updateGuardian')->name('user_guardian_update');
        Route::delete('/user', 'deleteUser')->name('user_deletion');
    });
    Route::get('/recource/not-found', function () {
        return view('errors.404');
    });
    Route::get('/liste/user', function () {
        return view('apprenant.index');
    });
    Route::get('/user/pay', function () {
        return view('paiement.index');
    })->name('user_pay');
    Route::get('/student/compte', function () {
        return view('compte.index');
    });
    Route::get('/search/user', function () {
        return view('searchuser.index');
    });

    Route::prefix('/admin')->group(function () {
        Route::controller(LanguageController::class)->group(function () {
            Route::get('/languages', 'index')->name('languages');
            Route::get('/languages/create', 'create')->name('languages.create');
            Route::post('/languages', 'store')->name('languages.store');
            Route::get('/languages/{id}/edit', 'edit')->name('languages.edit');
            Route::post('/languages/{id}', 'update')->name('languages.update');
            Route::delete('/languages/{id}', 'delete')->name('languages.delete');
        });
    });
});

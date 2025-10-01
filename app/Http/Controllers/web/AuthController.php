<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Managers\Constants;
use App\Managers\SettingsManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        if ($request->isMethod('POST')) {
            $user = User::whereIn('user_type', [Constants::DEALER, Constants::BANK_DELEGATE])
                ->where('email', $request->get('email'))
                ->first();
            if (!$user instanceof User) {
                return Redirect::back()->with(['error' => 'Error in email or password']);
            }
            if (!$user->email_verified_at) {
                return Redirect::back()->with(['error' => 'Email is not verified']);
            }
            if (! $user || ! Hash::check($request->get('password'), $user->password)) {
                return Redirect::back()->with(['error' => 'Unauthorised']);
            } else {
                Auth::login($user);
                $token = $user->createToken('MyApp')->plainTextToken;
                Session::put('auth_token', $token);

                return Redirect::route('home');
            }

        } else {
            $local = app()->getLocale();
            $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
            $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
            $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

            return view('web.auth.login',  compact(
                'customer_care_mobile', 'customer_care_email', 'location',
                'local'
            ));
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return \redirect()->route('login');
    }
}

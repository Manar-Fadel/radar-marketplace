<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\web\CreateUserRequest;
use App\Managers\AdminManager;
use App\Managers\Constants;
use App\Managers\SettingsManager;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
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
            if (!$user || ! Hash::check($request->get('password'), $user->password)) {
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

    public function register(Request $request): \Illuminate\Http\RedirectResponse|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
    {
        if ($request->isMethod('POST')) {
            $user = User::create([
                'full_name' => $request->input('full_name'),
                'id_number' => $request->input('id_number'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'phone_number' => $request->input('phone_number'),
                'user_type' => $request->input('user_type'),
                'is_verified_email' => false,
                'is_verified_admin' => false,
                'is_trusted' => false,
            ]);

            if (!$user instanceof User) {
                return Redirect::back()->with(['error' => 'Error in saving data']);
            }

            if ($request->has('showroom_doc')) {
                $doc_name = AdminManager::uploadImageFile($request->file('showroom_doc'), 'uploads/dealers/showroom_docs/');
                $user->showroom_doc = $doc_name;
                $user->save();
            }
            if ($request->has('document_url')) {
                $doc_name = AdminManager::uploadImageFile($request->file('document_url'), 'uploads/bank-delegates/document_urls/');
                $user->document_url = $doc_name;
                $user->save();
            }

            //event(new Registered($user));
            Session::flash('message', 'Email verification link sent to your email address, please check your email');

            return Redirect::route('login');

        }else{
            $local = app()->getLocale();
            $customer_care_mobile = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_MOBILE');
            $customer_care_email = SettingsManager::getSettingsValueByKey('CUSTOMER_CARE_EMAIL');
            $location = $local == 'ar' ? SettingsManager::getSettingsValueByKey('LOCATION_AR') : SettingsManager::getSettingsValueByKey('LOCATION_EN');

            return view('web.auth.register',  compact(
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

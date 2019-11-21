<?php

namespace App\Http\Controllers\Auth;

use App\Affiliate;
use App\AffiliatedMember;
use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       
        $settings = Setting::pluck('value', 'name')->all();
        if ($user){
            $data = array(
                'name' => $user->name,
                'user_email' => $user->email,
                'subject' => "Registration",
                'msg' => "Your Account is Created Successfully",
                'email' => isset($settings['email'])? $settings['email']:'info@approvedroofers.co.uk',
                'logo' => isset($settings['logo']) ? $settings['logo']: '',
                'site_title' => isset($settings['site_title']) ? $settings['site_title']: 'www.approvedroofers.co.uk',
            );
            Mail::send('themes.emails.registered', $data, function ($message) use ($data) {
                $message->to($data['user_email'],'')
                    ->from($data['email'],$data['site_title'])
                    ->subject('registered');
            });
             Mail::send('themes.emails.registered', $data, function ($message) use ($data) {
                $message->to($data['email'],'')
                    ->from($data['email'],$data['site_title'])
                    ->subject('registered');
            });
            return $user;
        }
    }
}

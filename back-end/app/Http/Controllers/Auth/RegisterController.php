<?php

namespace App\Http\Controllers\Auth;

use App\CityAgent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
            'agent_name' => ['required', 'string', 'max:255'],
            'agent_phone_number' => ['required','min:10','max:10','unique:city_agents'],
            'agent_email_address' => ['required', 'string', 'email', 'max:255', 'unique:city_agents'],
            'agent_password' => ['required', 'string', 'min:6', 'confirmed'],
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
        return CityAgent::create([
            'agent_name' => $data['agent_name'],
            'agent_email_address' => $data['agent_email_address'],
            'agent_phone_number' => $data['agent_phone_number'],
            'password' => Hash::make($data['agent_password']),
            'remember_token' => str_random(10),
        ]);
    }
}

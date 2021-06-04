<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        // View
        return view('auth.'.setting('site.view.register'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = route('member.dashboard');

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'nomor_hp' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], array_validation_messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {		
		// Create user
		$user = new User;
		$user->nama_user = $data['nama_lengkap'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		$user->tanggal_lahir = generate_date_format($data['tanggal_lahir'], 'y-m-d');
		$user->jenis_kelamin = $data['jenis_kelamin'];
		$user->nomor_hp = $data['nomor_hp'];
		$user->foto = '';
		$user->role = role('member');
        $user->is_admin = 0;
        $user->status = 0;
		$user->email_verified = 0;
        $user->last_visit = null;
		$user->register_at = date('Y-m-d H:i:s');
		$user->save();
		
		return $user;
    }
}

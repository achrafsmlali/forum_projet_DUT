<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/


	use AuthenticatesAndRegistersUsers;

	protected $redirectPath='/';
	protected $LoginPath='/auth/login';
	protected $redirectAfterLogout='/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}


	public function create(array $data)
    {
         return \App\User::create([
			'name'=>$data['name'],
			'image_link'=>$data['image_link'],
			'email'=>$data['email'],
			'password'=>bcrypt($data['password']),
		]);
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $data = ['name'=>$user->name,'email'=>$user->email,'password'=>$user->token];
		$userDB= \App\User::where('email',$user->email)->first();
		if(!is_null($userDB)){
			Auth::login($userDB);
		}
		else{
		Auth::login($this->create($data));
		}
		return redirect('/');
    }
}

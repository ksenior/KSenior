<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Login|Cierre de sesión satisfactorio');
        return redirect('/')->with(Auth::logout());
    }

    public function login(Request $request)
    {
        $errors = '';
        $user = null;

        $validacion = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required'
        ]);

        if ($validacion->fails())
        {
            //Log::alert($_SERVER['HTTP_X_FORWARDED_FOR'].'| NI | Inicio de sesión | Error en inicio de sesión |Error en consulta '.$validacion->errors());
            return redirect()->back()->withInput()->withErrors($validacion->errors());
        }

        $this->validateLogin($request);

        $users = DB::connection('mysql')->select(  DB::raw("
            SELECT *
            from users
            where username = '$request->username'"
        ));

        if (sizeof($users) == 0){
            $errors = array('active_user' => 'Usuario y/o contraseña errada');
            //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Login|intento fallido de inicio de sesión, usuario no registrado');
            return redirect()   ->back()
                                ->withInput($request->only('username', 'remember'))
                                ->withErrors($errors);
        }
        
        $user = $users[0];

        if (!$user->status){
            $errors = array('active_user' => 'Usuario y/o contraseña errada');
            //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Login|intento fallido de inicio de sesión de '.$user->name.' , se encuentra inactivo');
            return redirect()   ->back()
                                ->withInput($request->only('username', 'remember'))
                                ->withErrors($errors);
        }

        if (!empty($user)){
            if(!Hash::check($request->password, $user->password)){
                $errors = ['password' => trans('Usuario y/o contraseña errada')];
                //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Login|intento fallido de inicio de sesión '.trans('passwords.failed'));
                return redirect()   ->back()
                                    ->withInput($request->only('username', 'remember'))
                                    ->withErrors($errors);
            }
        }

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            //Log::info($_SERVER['HTTP_X_FORWARDED_FOR'].'|NI|Login|inicio de sesión satisfactorio');
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function username(){
        return 'username';
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginRateLimiter;
use App\Models\Modulos\Seguridad\Usuario\SegUsuario;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
    // use AuthenticatesUsers;

    protected $limiter = 1;

    /*protected $maxAttempts = 1; // Default is 5, # de Cantidad de intentos permitidos antes de bloquear al user
    protected $decayMinutes = 1; // Default is 1, # de Tiempo en minutos que durara el bloqueo
    public $key;   */


    //Si el user no esta autenticado se lo redirige a la vista login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $this->validateLogin($request);

        $this->sendFailedLoginResponse($request);

        if (Auth::attempt(['usuario' => $request->input('usuario'),'password' => $request->input('password')])){
            //$user = SegUsuario::where('usuario', $request->input('usuario'))->first();
            /* return response()->json(['user' => $user, 'request' => $request->input()]); */
            //Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('main');
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales introducidas son incorrectas.',
        ]);
    }

    public function authenticate2(Request $request)
    {
        $this->validateLogin($request);
        $credentials = $request->only('email', 'password');

        $this->sendFailedLoginResponse($request);

       // $this->limiter()->hit($this->throttleKey($request));

        /* if (Auth::attempt(['email' => $request->email,'password' => $request->password,'condicion'=>1])){
            return redirect()->route('main');
        } */

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }
    public function authenticate1(Request $request)
    {
        return redirect()->route('main');
        $credentials = $request->only('email', 'password', '_token');
        $this->validateLogin($request);
        $user = User::where('usuario', $request->input('email'))->first();
        if ($user === null) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ]);
        }

        if (Auth::attempt(['usuario' => $request->input('email'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->route('main');
        }

        //$password =  Hash::make($request->input('password'));
        /* if(password_verify($request->input('password'), $user->password )){
            //Auth::login($user);
            $request->session()->regenerate();
            //return response()->json(['user' => $user, 'request' => $request->input()]);
            return redirect()->route('main');
        } */





        /* return response()->json(['user' => $user, 'request' => $request]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('main');
        } */


        $this->sendFailedLoginResponse($request);
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('throttle:2,1')->only('login');
    }


    public function sendFailedLoginResponse(Request $request)
    {
        $attempts = session()->get('login.attempts', 1); // obtener intentos, default: 0
        if ($attempts <= 2) {
            session()->put('login.attempts', $attempts + 1); // incrementrar intentos
            return redirect()->back()->withErrors('status', 'intento :' . $attempts);
        }
    }
}

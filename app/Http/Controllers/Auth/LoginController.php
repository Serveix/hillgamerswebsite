<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = '/';

    /**
     * @return string
     */
    public function username() {
        return 'username';
    }

    public function loginMinecraft(Request $request) {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where($this->username(), $request->input($this->username()))->first();

        if ($user)
        {
            $dbPassArr = explode('$', $user->password);
            $dbSalt = $dbPassArr[2];
            Log::debug($dbSalt);
            $inputPass = hash('sha256', hash('sha256', $request->input('password')) . $dbSalt);
            Log::debug($inputPass);

            if ($inputPass == $dbPassArr[3]) {
               Auth::login($user, true);
               return redirect('/');
            }
            else
            {
                return back()->with('error', 'Contraseña incorrecta');
            }
        }
        else
        {
            return back()->with('error', 'El usuario no existe.');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

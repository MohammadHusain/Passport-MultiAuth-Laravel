<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    // user login
    public function user_login(Request $request)
    {
        
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 202);
        }

        if (auth()->guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'token' => auth()->guard('user')->user()->createToken('User')->accessToken
            ], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // admin login
    public function admin_login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 202);
        }

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'token' => auth()->guard('admin')->user()->createToken('Admins')->accessToken
            ], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }


    // Superadmin login
    public function superadmin_login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 202);
        }

        if (auth()->guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'token' => auth()->guard('superadmin')->user()->createToken('Superadmin')->accessToken
            ], 200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

}

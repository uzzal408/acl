<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected $redirectTo = '/admin';


    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'         => 'required|email',
            'password'      => 'required|min:6',
        ]);

        if(Auth::guard('admin')->attempt([
            'email'         => $request->email,
            'password'      => $request->password,
        ],$request->get('remember'))){
            $role_id = \Illuminate\Support\Facades\Auth::guard('admin')->user()->role_id;
            $mobile = \Illuminate\Support\Facades\Auth::guard('admin')->user()->mobile;
            if($role_id == 5) {
                Session::put('email',$request->email);
                Session::put('password',$request->password);
                Auth::guard('admin')->logout();
                $this->get_otp = $this->getOtp();
                Session::put('loginotp',$this->get_otp);
                //echo 'OTP: '.$this->get_otp;
                //exit;
                $this->sendOTP($mobile,$this->get_otp);
                return redirect()->route('admin.loginotp');
            }
            else
                return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email','remember'));
    }

    public function showOtpForm()
    {
        return view('admin.auth.loginotp');
    }

    public function loginotp(Request $request)
    {
        $this->validate($request,[
            'otp'         => 'required|digits:6',
        ]);

        //echo Session::get('loginotp');
        //echo $request->email;
        //exit;

        if($request->otp==Session::get('loginotp')) {
            if (Auth::guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ], $request->get('remember'))) {
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        return back()->withInput($request->only('otp','remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }
    public function sendOTP($mobile,$otp){
        $parent_mobile = $mobile;
        $user = "TranscomFoodAPI";
        $pass = "o54=8P96";
        $sid = "KFCONLINEENG";
        $url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
        $param="user=$user&pass=$pass&sms[0][0]= 88$parent_mobile &sms[0][1]=".urlencode("Your OTP pin code is $otp")."&sms[0][2]=123456789&sid=$sid";
        $crl = curl_init();
        curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($crl,CURLOPT_URL,$url);
        curl_setopt($crl,CURLOPT_HEADER,0);
        curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($crl,CURLOPT_POST,1);
        curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
        $response = curl_exec($crl);
        curl_close($crl);
//        dd($response);
    }

    public function getOtp(){
        return rand(100000,999999);
    }
}

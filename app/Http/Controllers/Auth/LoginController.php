<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Crypt;
use Cookie;
use Illuminate\Http\Request;
use \Common\Common;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    //登陆页面
    public function showLoginForm(Request $request)
    {
        $arr = array('status'=>'200');
        $reque = $request->all();
        $rules    = [
            'callback'     => 'required',
            'details'      => 'required',
            '_secret'      => 'required',
        ];
    
        $v = Validator::make($reque, $rules);
         
        if ($v->fails()) {
            $arr['status'] = 3;
            return response($reque['callback'].'('.json_encode($arr).')');
        }
         
        $user_cont = Crypt::decrypt($reque['details']);
    
        //验证是否有效
        $new_secret = MD5($reque['details'].Common::$auth_secret);
        if($reque['_secret'] != $new_secret){
            $arr['status'] = 2;
            return response($reque['callback'].'('.json_encode($arr).')');die;
        }
    
        return response($reque['callback'].'('.json_encode($arr).')')->withCookie(Cookie::forever('nk', $user_cont['nk']))->withCookie(Cookie::forever('uid',$user_cont['uid']));
    
        //return view('auth.login');
    }
    
    /**
     * 登出
     */
    public function logout(Request $request)
    {
        $reque = $request->all();
        $arr = array('status'=>'200');
         
        return response($reque['callback'].'('.json_encode($arr).')')->withCookie(Cookie::forget('nk'))->withCookie(Cookie::forget('uid'));
        //return response('hello world')->withCookie(Cookie::forget('nk'))->withCookie(Cookie::forget('uid'));
    }
}

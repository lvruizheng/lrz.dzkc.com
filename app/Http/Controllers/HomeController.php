<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Common\Common;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
		$client = new Client;
		$response = $client->post('http://lrz.ucenter.com/oauth/token', [
			'form_params' => [
				'grant_type' => 'password',
				'client_id' => '4',
				'client_secret' => 'q6V1nmCL3zsqxouLVbiZML9tWWdXioRpgYRimlck',
				'username' => '15810312145@163.com',
				'password' => '123456',
				'scope' => '',
			],
		]);

		$result = json_decode($response->getBody(), true);
		
		
		$response = $client->request('GET', 'http://lrz.ucenter.com/api/test', [
			'headers' => [
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '.$result['access_token'],
			],
		]);
		
		var_dump(json_decode($response->getBody(), true));die;
		
		*/
		
        
        
        return view('home');
    }
}

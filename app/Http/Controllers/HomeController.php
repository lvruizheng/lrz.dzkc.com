<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Common\Common;
use GuzzleHttp\Client;
use \App\Models\Article;

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
		$client = new Client;
		$response = $client->request('post','http://guys.zhengzai.tv/api/user/login', [
			'headers' => [
				//'Accept' => 'application/json',
				//'token' => 'Y3jmHpZYtrrUsVjVmOMQ5GnfYwTBDBWtEsmHaDB7',
				//'Access-Token' => '15810312145'
			],
			'form_params' => [
				'username' => 'admin',
				'password' => '9ol./;p0',
				//'mobile' => '15001368203',
			],
		]);

		$result = json_decode($response->getBody(), true);
		//var_dump($result);die;
		
		/*$response = $client->request('post', 'http://lrz.small_program_back.com/api/admin/project/create', [
			'headers' => [
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '.$result['access_token'],
			],
			'form_params' => [
				'end' => '2018-04-26 00:00:00',
				'image' => 'http://smallguys.oss-cn-qingdao.aliyuncs.com/smallApp/1522042227-99b0e9bb924c6164795935.jpeg',
				'intro' => '收拾收拾',
				'location' => '谁是谁',
				'money' => '',
				'points' => '',
				'need' => '200',
				'showObey' => false,
				'start' => '2018-03-28 00:00:00',
				'title' => '红黄紫',
				'tasks' => [
						0 =>[
								'end' => "2018-04-15 18:21:10",
								'id' => '10',
								'introduce' => "打算",
								'location' => "打算的",
								'start' => "2018-04-13 18:21:03",
								'title' => "媒体组",
							]
				],
			]
		]);*/

		
		$response = $client->request('get', 'http://guys.zhengzai.tv/api/project/get?page=1&size=10', [
			'headers' => [
				//'Accept' => 'application/json',
				//'Authorization' => 'Bearer '.$result['access_token'],
				'token' => 'WyJOAyxDaP6FACrVweFEIYBflBpGOKhKwV7omi9K',
			],
			/*'form_params' => [
				'dealType' => 2,
				'projectId'=>"31",
				'taskId'=>[77,78],
				'wxuserId'=>"381",
			]*/
		]);
		
		var_dump(json_decode($response->getBody(), true));die;
        


		$response = $client->request('get', 'http://guys.zhengzai.tv/api/admin/wxuser/info?wxuserId=469', [
			'headers' => [
				'Accept' => 'application/json',
				'Authorization' => 'Bearer '.$result['access_token'],
			],
			/*'form_params' => [
				'dealType' => 2,
				'projectId'=>"31",
				'taskId'=>[77,78],
				'wxuserId'=>"381",
			]*/
		]);
		
		var_dump(json_decode($response->getBody(), true));die;
        
        return view('home')->withArticles(Article::all());
        //return view('home');
    }
}

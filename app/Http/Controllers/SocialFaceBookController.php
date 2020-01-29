<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\Account;
use App\SearchQuery;
use App\Event;
use App\Position;

class SocialFaceBookController extends Controller
{
	public function test()
	{
		//https://graph.facebook.com/1232423/picture?type=small
		return $this->createOrUpdate(1232423, 'mail@yandex.ru', 'Петр', 'Степанович', 'Зощенко');
	}


	public function redirectToProvider()
	{
		return Socialite::driver('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
		$driver = Socialite::driver('facebook')->fields(['first_name', 'middle_name', 'last_name', 'email']);
		$user = Socialite::driver('facebook')->user();
		// handle not registered case
		// return error view
		
		// otherwise go further
		
		return $this->createOrUpdate(
		$user->user['id'],
		$user->user['email'],
		$user->user['first_name'], 
		'',//$user->user['middle_name'], 
		$user->user['last_name']);
	}
	
	public function createOrUpdate($id, $email, $fname, $mname, $lname)
	{
		$account = Account::updateOrCreate(
			['id' => $id],
			['facebook_login' => $email,
			'first_name' => $fname,
			'middle_name' => $mname,
			'last_name' => $lname]
		);
		
		$this->savePhoto($id);
		
		$this->SetSessionData($id);

		return $this->commonStep1Logic();
	}
	
	public function savePhoto($id)
	{
		$arrContextOptions=['ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]];
		$fbUrl = 'https://graph.facebook.com/'.$id.'/picture?type=small';
		$file = 'profile_'.$id.'.jpg';
		file_put_contents('..\\storage\\app\\public\\img\\'.$file, fopen($fbUrl, 'r'));
	}
}

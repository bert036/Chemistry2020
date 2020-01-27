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
		return $this->createOrUpdate('mail@yandex.ru', 'Петр', 'Степанович', 'Зощенко');
	}


	public function redirectToProvider()
	{
		//return $this->createOrUpdate('2@1.ru', '11', '22', '33');
		return Socialite::driver('facebook')->redirect();
	}

	public function handleProviderCallback()
	{
		$driver = Socialite::driver('facebook')->fields(['first_name', 'middle_name', 'last_name', 'email']);
		$user = Socialite::driver('facebook')->user();
		// handle not registered case
		// return error view
		
		// otherwise go further		
		return $this->createOrUpdate($user->user['email'], $user->user['first_name'], 
		'',//$user->user['middle_name'], 
		$user->user['last_name']);
	}
	
	public function createOrUpdate($email, $fname, $mname, $lname)
	{
		$account = Account::updateOrCreate(
			['facebook_login' => $email],
			['name' => $fname, 'patronymic' => $mname, 'surname' => $lname]
		);
		
		$this->SetSessionData($email);

		return $this->commonStep1Logic();
	}
}

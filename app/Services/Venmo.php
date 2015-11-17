<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Venmo {

	protected $client;
	protected $service;

	/**
	 * Setup for Venmo API authorization to retrieve directory data
	 */
	function __construct() {

	/*
	go here

		https://api.venmo.com/v1/oauth/authorize?client_id=3133&scope=make_payments%20access_payment_history%20access_feed%20access_friends%20access_balance&response_type=code

	redirects to

		https://myexampleapp.com/oauth?code=AUTHORIZATION_CODE

		http://drd-clock2.dev/payments/redirect?code=a8e8889ca8e81052b8f1258551b8ec76

	then go to:

		https://api.venmo.com/v1/oauth/access_token

		with:

		client_id, code, client_secret

	returns: 

		"{"access_token": "a5bc08728679f91aaf5b88a4a34e0c594a42fad32b3f7b742134c21fd23fb266", 
		"expires_in": 5184000,
		 "token_type": "bearer", 
		 "user": {"username": "stacie-wilhelm", "last_name": "Wilhelm", "friends_count": 57, "is_group": false, "is_active": true, "trust_request": null, "phone": "19705811254", "profile_picture_url": "https://venmopics.appspot.com/u/v1/s/49940d41-575c-4fc0-931d-1b8a51340b09", "is_blocked": false, "id": "1026098422874112457", "identity": null, "date_joined": "2012-11-16T17:54:24", "about": "The short person. ", "display_name": "Midge Wilhelm", "first_name": "Midge", "friend_status": null, "email": "stacie.wilhelm@gmail.com"}, 
		 "balance": "152.41", 
		 "refresh_token": "f679f2d6342f686dd3033c1c80fbbeb9cb5787e7f233fadfed5fea0244b10db0"}"

	then can access

		/v1/payments?access_token=d26e204ce8f158a738547e0b551bc2aeac4fca8b55e32eb4cdd4699763b4895d 

	*/
	}

	public function accessToken($code) {
		$endpoint = 'https://api.venmo.com/v1/oauth/access_token';

		// Use one of the parameter configurations listed at the top of the post
		$params = array(
			'client_id' => Config::get('venmo.client_id'),
			'client_secret' => Config::get('venmo.client_secret'),
			'code' => $code
		);

		$ci = curl_init($endpoint);
		curl_setopt($ci, CURLOPT_HEADER, true);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ci, CURLOPT_POST, true);
		curl_setopt($ci, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');

		// Remove comment if you have a setup that causes ssl validation to fail
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$postData = '';

		//This is needed to properly form post the credentials object
		foreach($params as $k => $v) {
			$postData .= $k . '='.urlencode($v).'&';
		}

		$postData = rtrim($postData, '&');

		var_dump($postData);

		curl_setopt($ci, CURLOPT_POSTFIELDS, $postData);
		echo "Performing Request...";

		$json_response = curl_exec($ci);

		$status = curl_getinfo($ci, CURLINFO_HTTP_CODE);
		var_dump($status);
		// evaluate for success response
		if ($status != 200) {
			//throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
			var_dump("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($ci) . ", curl_errno " . curl_errno($ci) . "\n");
		}
		curl_close($ci);

		return $json_response;

	}

	public function getPayments($token) {
		$endpoint = 'https://api.venmo.com/v1/me?access_token='.$token;

		$curl = curl_init($endpoint);
		curl_setopt($curl, CURLOPT_HEADER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');

		echo "Performing Request...";

		$json_response = curl_exec($curl);

		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

		// evaluate for success response
		if ($status != 200) {
		  //throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
		  var_dump("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
		}
		curl_close($curl);

		return $json_response;

	}

}
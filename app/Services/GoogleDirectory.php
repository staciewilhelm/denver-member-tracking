<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GoogleDirectory {

	protected $client;
	protected $service;

	/**
	 * Setup for Google API authorization to retrieve directory data
	 */
	function __construct() {
		// set config options
		$clientId = Config::get('google.client_id');
		$serviceAccountName = Config::get('google.service_account_name');
		$delegatedAdmin = Config::get('google.admin_email');
		$keyFile = base_path() . Config::get('google.key_file_location');
		$appName = Config::get('google.app_name');

		// array of scopes
		$scopes = array(
			'https://www.googleapis.com/auth/admin.directory.user',
			'https://www.googleapis.com/auth/admin.directory.user.readonly'
		);

		// Create AssertionCredentails object for use with Google_Client
		$creds = new \Google_Auth_AssertionCredentials(
			$serviceAccountName,
			$scopes,
			file_get_contents($keyFile)
		);
		// set admin identity for API requests
		$creds->sub = $delegatedAdmin;

		// Create Google_Client to allow making API calls
		$this->client = new \Google_Client();
		$this->client->setApplicationName($appName);
		$this->client->setClientId($clientId);
		$this->client->setAssertionCredentials($creds);

    if ($this->client->getAuth()->isAccessTokenExpired()) {
			$this->client->getAuth()->refreshTokenWithAssertion($creds);
		}
		Cache::forever('service_token', $this->client->getAccessToken());

		// Set instance of Directory object for making Directory API related calls
		$this->service = new \Google_Service_Directory($this->client);
	}

	/**
	 * Retrieve a list of all active users per the limit parameter
	 *
	 * @param  number  $limit
	 * @return array
	 */
	public function getUsers($limit) {

		return $this->service->users->listUsers(
			array(
				'domain' => 'denverrollerderby.org',
				'orderBy' => 'email',
				'sortOrder' => 'ASCENDING',
				'viewType' => 'admin_view',
				'maxResults' => $limit
			)
		);

	}

	/**
	 * userKey: Identifies the user in the API request. The value can be the 
	 * user's primary email address, alias email address, or unique user ID.
	 *
	 * @param  number  $userKey
	 * @return Response
	 */
	public function getOneUser($userKey) {

		return $this->service->users->get(
			array(
				'userKey' => $userKey,
				'viewType' => 'admin_view'
			)
		);

	}

}
<?php namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class GoogleCalendar {

	protected $client;
	protected $service;
	protected $optParams;

	/**
	 * Setup for Google API authorization to retrieve calendar data
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
			'https://www.googleapis.com/auth/calendar'
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

		// Set instance of Calendar object for making Calendar API related calls
		$this->service = new \Google_Service_Calendar($this->client);
	}

	/**
	 * Retrieve all events from Activities & Events calendar
	 *
	 * @param  ISO Date  $fromDate  
	 * @return array
	 */
	public function getActivities($fromDate = null) {
		date_default_timezone_set('America/Denver');

		$this->optParams = array(
			'orderBy' => 'startTime',
			'singleEvents' => TRUE,
			'timeMin' => date('c', strtotime('-2 week')),
			'timeMax' => date('c', strtotime('+15 minute')),
		);

		return $this->service->events->listEvents(Config::get('google.calendar_ids.activities'), $this->optParams);
	}

	/**
	 * Retrieve all events from Practices & Bouts calendar
	 *
	 * @param  ISO Date  $fromDate  
	 * @return array
	 */
	public function getPractices($fromDate = null) {
		date_default_timezone_set('America/Denver');

		$this->optParams = array(
			'orderBy' => 'startTime',
			'singleEvents' => TRUE,
			'timeMin' => date('c', strtotime('-2 week')),
			'timeMax' => date('c', strtotime('+15 minute')),
		);

		return $this->service->events->listEvents(Config::get('google.calendar_ids.practices'), $this->optParams);
	}

	/**
	 * Retrieve all events from Glitterdome calendar
	 *
	 * @param  ISO Date  $fromDate  
	 * @return array
	 */
	public function getGlitterdomeEvents($fromDate = null) {
		date_default_timezone_set('America/Denver');

		$this->optParams = array(
			'orderBy' => 'startTime',
			'singleEvents' => TRUE,
			'timeMin' => date('c', strtotime('-2 week')),
			'timeMax' => date('c', strtotime('+15 minute')),
		);

		return $this->service->events->listEvents(Config::get('google.calendar_ids.glitterdome'), $this->optParams);
	}

	/**
	 * Merge events from Practices & Bouts, Activities & Events and Glitterdome calendars
	 * @TODO figure out a better way to implement
	 * 
	 * @return array
	 */
	public function getMergedEvents() {
		$mergedEvents = [];
		foreach ($this->getGlitterdomeEvents()->getItems() as $event) {
			$mergedEvents[] = $event;
		}
		foreach ($this->getPractices()->getItems() as $event) {
			$mergedEvents[] = $event;
		}
		foreach ($this->getActivities()->getItems() as $event) {
			$mergedEvents[] = $event;
		}
		return $mergedEvents;
	}

	/**
	 * Formats data from Calendar into desired format
	 * for select menu for user selection
	 *
	 * @param array  $events
	 * @return array
	 */
	public function formatEventData($events) {
		$dateList = $eventList = [];
		try {
			foreach ($events as $key => $event) {
				if ($this->includeEvent($event) && !empty($this->getEventType($event['summary']))) {
					$type = $this->getEventType($event['summary']);
					// if no dateTime, all day event that should be just date
					$isAllDay = (isset($event['modelData']['start']['date']) && isset($event['modelData']['end']['date'])) ? true : false;
					$startDateTime = isset($event['modelData']['start']['dateTime']) ? $event['modelData']['start']['dateTime'] : $event['modelData']['start']['date'];
					$endDateTime = isset($event['modelData']['end']['dateTime']) ? $event['modelData']['end']['dateTime'] : $event['modelData']['end']['date'];

					$displayDateTime = date('h:iA', strtotime($startDateTime)).' - '.date('h:iA', strtotime($endDateTime));
					if ($isAllDay) $displayDateTime = date('D M j, Y', strtotime($startDateTime)).' - '.date('D M j, Y', strtotime($endDateTime));

					//$info = array(
					//	'type' => $type,
					//	'status' => $event['status'],
					//	'title' => $event['summary'],
					//	'isAllDay' => $isAllDay,
					//	'start' => $startDateTime,
					//	'end' => $endDateTime,
					//	'display' => $type.': '.$event['summary'].' ['.$displayDateTime.']'
					//);

					$info = array(
						'group' => date('l F j, Y', strtotime($startDateTime)),
						'display' => $displayDateTime.' | '.$type.': '.$event['summary'],
					);

					$dateList[] = $startDateTime;
					$eventList[] = $info;
				}
			}
			return array('dates'=>$dateList, 'events'=>$eventList);

		} catch (Exception $e) {
			return $e;
		}
	}

	/**
	 * Long-ass if statement to check if the event
	 * should be included in the select menu
	 *
	 * @param array  $event
	 * @return boolean
	 */
	protected function includeEvent($event) {
		// remove $event['status'] === 'confirmed' check since there's
		// no way outside of the API to change the status of an event.
		if (
			stripos($event['summary'], 'Detour') === false &&
			stripos($event['summary'], 'Junior') === false &&
			stripos($event['summary'], 'Away') === false &&
			stripos($event['summary'], 'Draft') === false &&
			stripos($event['summary'], 'Scrappy Hour') === false &&
			stripos($event['summary'], 'Recruitment') === false
		) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Switch statement to determine the type
	 * of event
	 *
	 * @param string  $title
	 * @return array
	 */
	protected function getEventType($title) {
		switch (true) {
			case stripos($title, 'Activity') !== false:
			case stripos($title, 'Skate Maintenance') !== false:
			case stripos($title, 'Bootcamp') !== false:
			case stripos($title, 'Roll') !== false:
			case stripos($title, 'Bout') !== false:
			case stripos($title, 'Track Cleaning') !== false:
				$type = 'Activity';
				break;
			case stripos($title, 'Scrimmage') !== false:
			case stripos($title, 'vs') !== false:
				$type = 'Scrimmage';
				break;
			case stripos($title, 'MHC') !== false:
			
			case stripos($title, 'Bruising') !== false:
			case stripos($title, 'Brats') !== false:
			
			case stripos($title, 'Ground Control') !== false:
			case stripos($title, 'GC') !== false:

			case stripos($title, 'Standbys') !== false:
			
			case stripos($title, 'Flight School') !== false:
			case stripos($title, 'FS') !== false:
			
			case stripos($title, 'Test-Up') !== false:
			case stripos($title, 'Test Ups') !== false:
			case stripos($title, 'Ref Testing') !== false:
			
			case stripos($title, 'League -') !== false:
			case stripos($title, 'League Meeting') !== false:
				$type = 'Practice';
				break;
			default:
				$type = null;
				break;
		}
		return $type;
	}

}
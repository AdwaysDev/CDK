<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Adways SA. (http://www.adways.com)
 */
namespace Adways;

class Client implements ClientInterface
{		
	private $client_id;
	private $client_secret;
	private $client_token;
	
	public function __construct($client_id = null, $client_secret = null) {
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
		$this->client_token = null;
	}
	
	public function getClientToken() {
		if($this->client_token == null) $this->retrieveToken();
		return $this->client_token;
	}
	
	private function retrieveToken() {
		if($this->client_id != null && $this->client_secret != null) {
			// Here we need to make a request to get a token from given client_id, client_secret
			
			// tmp hack
			$this->client_token = 'aabbccdd11223344';
		}
	}
}
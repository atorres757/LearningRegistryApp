<?php
namespace LRRepo;

class ResultsFetcher{
	public $client;
	public $server;
	public $query;
	public $resultCount;
	private $resumptionToken;

	public function __construct($client, $server, $query){
		$this->client = $client;
		$this->server = $server;
		$this->query = $query;
		$this->resumptionToken = null;
	}

	private function getViewQueryUri(){
		$path = $this->server;
		$path .= '/slice?any_tags=';
		$path .= $this->query;
		if($this->resumptionToken !== null){
			$path .= '&resumption_token=' . $this->resumptionToken;
		}
		return $path;
	}

	public function fetchResults(){
		$uri = $this->getViewQueryUri();
		$this->client->setUri($uri);
		$response = $this->client->request(\Zend_http_Client::GET);
		$result = json_decode($response->getBody());
		$this->resumptionToken = $result->resumption_token;
		$this->resultCount = $result->resultCount;
		return $result->documents;
	}
}
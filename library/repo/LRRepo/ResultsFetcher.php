<?php
namespace LRRepo;

class ResultsFetcher{
	public $client;
	public $server;
	public $query;
	public $resultCount;
	public $endOfResults;
	private $resumptionToken;

	public function __construct($client, $server, $query){
		$this->client = $client;
		$this->server = $server;
		$this->query = $query;
		$this->resumptionToken = null;
		$this->endOfResults = false;
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
		if($this->endOfResults) return array();
		$uri = $this->getViewQueryUri();
		$this->client->setUri($uri);
		$response = $this->client->request(\Zend_http_Client::GET);
		$result = json_decode($response->getBody());
		if(isset($result->resumption_token)){
			$this->resumptionToken = $result->resumption_token;
		} else {
			$this->endOfResults = true;
		}
		$this->resultCount = $result->resultCount;
		return $result->documents;
	}
}
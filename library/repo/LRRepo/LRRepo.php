<?php

namespace LRRepo;

class LRRepo{
	public $lrServerUri;
	public $httpClient;
	
	public function __construct($lrServerUri){
		$this->lrServerUri = $lrServerUri;
		$this->httpClient = new \Zend_Http_Client();
		$this->httpClient->setConfig(array(
				'maxredirects' => 5,
				'timeout'      => 30));
		$this->httpClient->setMethod(\Zend_Http_Client::GET);
	}
	

}
<?php

namespace repo;
use data\PlanObject;


class PlanRepo extends CouchRepo{
	
	public function __construct($couchServerUri){
		parent::__construct($couchServerUri, "plans");
	}
	
	public function save(PlanObject $plan){
		parent::save($plan, "plan");
	}
	
	public function getPlansById($string){
		//die($this->getViewQueryUri("plansById", array($string, $string . '\u9999')));
		//die($this->getViewQueryUri("plansById", array($string, $string . '\u9999'), 10));
		$this->httpClient->setUri(
				$this->getDocumentUri($string)
			);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
		
	}
	
	public function getPlansByCategory($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("plansByCategory", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getPlansByOwnerAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("plansByOwnerAutocomplete", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getPlansByOwner($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("plansByOwner", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getPlansByDateCreated($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("plansByDateCreated", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function map($json){
		$response = json_decode($json);
		if(!isset($response->rows)) return array();
		$results = array();
		foreach ($response->rows as $row){
			$plan = new PlanObject();
			$plan->_id = $row->value->_id;
			$plan->Category = $row->value->Category;
			$plan->DateCreated = $row->value->DateCreated;
			$plan->Owner = $row->value->Owner;
			$plan->Resources = $row->value->Resources;
			$results[] = $plan;			
		}
		return $results;
	}

	
}
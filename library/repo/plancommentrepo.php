<?php

namespace repo;
use data\PlanCommentObject;


class PlanCommentRepo extends CouchRepo{
	
	public function __construct($couchServerUri){
		parent::__construct($couchServerUri, "plancomments");
	}
	
	public function save(PlanCommentObject $plancomments){
		parent::save($plancomments, "plancomments");
	}
	
	public function getPlanCommentsByIdAutocomplete($string){
		//die($this->getViewQueryUri("planCommentsById", array($string, $string . '\u9999')));
		//die($this->getViewQueryUri("planCommentsById", array($string, $string . '\u9999'), 10));
		$this->httpClient->setUri(
				$this->getViewQueryUri("planCommentsById", array($string, $string . '\u9999'), 10)
			);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;	
	}
	
	public function getPlanCommentsByPlanIdAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("planCommentsByPlanId", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	
	public function getPlanCommentsRatingAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("planCommentsByRating", array($string, $string . '\u9999'), 10)
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
			$plancomment = new PlanCommentObject();
			$plancomment->_id = $row->value->_id;
			$plancomment->Content = $row->value->Content;
			$plancomment->AverageRating = $row->value->AverageRating;
			$plancomment->PlanId = $row->value->PlanId;
			$plancomment->Ratings = $row->value->Ratings;
			$results[] = $plancomment;			
		}
		return $results;
	}

	
}
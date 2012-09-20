<?php

namespace repo;
use data\ResourceCommentObject;


class ResourceCommentRepo extends CouchRepo{
	
	public function __construct($couchServerUri){
		parent::__construct($couchServerUri, "resourcecomments");
	}
	
	public function save(ResourceCommentObject $resourcecomments){
		parent::save($resourcecomments, "resourcecomments");
	}
	
	public function getResourceCommentsByIdAutocomplete($string){
		//die($this->getViewQueryUri("planCommentsById", array($string, $string . '\u9999')));
		//die($this->getViewQueryUri("planCommentsById", array($string, $string . '\u9999'), 10));
		$this->httpClient->setUri(
				$this->getViewQueryUri("resourceCommentsById", array($string, $string . '\u9999'), 10)
			);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;	
	}
	
	public function getResourceCommentsByResourceIdAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("resourceCommentsByResourceId", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	
	public function getResourceCommentsRatingAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("resourceCommentsByRating", array($string, $string . '\u9999'), 10)
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
			$comment = new ResourceCommentObject();
			$comment->_id = $row->value->_id;
			$comment->Content = $row->value->Content;
			$comment->ResourceId = $row->value->ResourceId;
			$comment->Ratings = $row->value->Ratings;
			$results[] = $comment;			
		}
		return $results;
	}

	
}
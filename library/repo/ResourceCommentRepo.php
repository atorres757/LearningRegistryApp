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
	
	public function getResourceCommentsById($string){
		$this->httpClient->setUri(
				$this->getDocumentUri($string)
			);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;	
	}
	
	public function getResourceCommentsByResourceId($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("resourceCommentsByResourceId", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	
	public function getResourceCommentsRating($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("resourceCommentsByRating", $string, 10)
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
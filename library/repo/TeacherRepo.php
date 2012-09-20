<?php

namespace repo;
use data\TeacherObject;


class TeacherRepo extends CouchRepo{
	
	public function __construct($couchServerUri){
		parent::__construct($couchServerUri, "teachers");
	}
	
	public function save(TeacherObject $teacher){
		parent::save($teacher, "teacher");
	}
	
	public function getTeachersById($string){
		//die($this->getViewQueryUri("teachersById", array($string, $string . '\u9999')));
		//die($this->getViewQueryUri("teachersById", array($string, $string . '\u9999'), 10));
		$this->httpClient->setUri(
				$this->getDocumentUri($string)
			);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
		
	}
	
	public function getTeachersByLastNameAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByLastName", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getTeachersByLastName($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByLastName", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getTeachersByFirstNameAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByFirstName", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getTeachersByFirstName($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByFirstName", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getTeachersBySchoolAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersBySchool", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	
	public function getTeachersBySchool($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersBySchool", $string, 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	public function getTeachersByEmailAutocomplete($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByEmail", array($string, $string . '\u9999'), 10)
		);
		$response = $this->httpClient->request(\Zend_http_Client::GET);
		$results = $this->map($response->getBody());
		return $results;
	}
	
	
	public function getTeachersByEmail($string){
		$this->httpClient->setUri(
				$this->getViewQueryUri("teachersByEmail", $string, 10)
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
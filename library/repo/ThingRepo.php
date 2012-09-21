<?php

namespace repo;
use data\PlanObject;


class ThingRepo extends CouchRepo{
	
	public function __construct($couchServerUri){
		parent::__construct($couchServerUri, "plans");
	}
	
	public function save(object $plan, $type){
		
		parent::save($plan, $type);
	}

	
}
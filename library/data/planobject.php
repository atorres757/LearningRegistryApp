<?php

namespace data;

class PlanObject extends CouchObject {
	public $Resources;
	public $Owner;
	public $DateCreated;
	public $Category;	
}

class PlanCategoryEnum {
	const MATH = 'Math';
	const SCIENCE = 'Science';
	const ENGLISH = 'English';
	const SOCIALSTUDIES = 'Social Studies';	
}
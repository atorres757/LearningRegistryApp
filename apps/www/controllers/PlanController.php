<?php

class PlanController extends Zend_Controller_Action
{

	protected $_reachitRepoUri;
	
	public function SavePlanAction () {
		$this->_helper->viewRenderer->setNoRender();
		
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		$this->_reachitRepoUri = $config->reachit->repodb;
		
		
	}
	
	public function SaveProfile () {
		
	}
	
	public function SaveResource () {
		
	}
	
	public function SavePlanComment () {
		
	}
	
	public function SaveResourceComment () {
		
	}
	
}
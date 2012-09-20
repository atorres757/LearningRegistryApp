<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    }
    
    public function registerAction () {
    	
    	if ($this->getRequest()->isPost()) {
    		$data = $this->getRequest()->getParams();
    		return $this->_redirect('/index/user-profile');
    	}
    	
    }
	
	public function loginAction () {
		
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getParams();
			return $this->_redirect('/index/user-profile');
		}
		
		$this->renderScript('/index/index.phtml');
	}
	
	public function userProfileAction () {
		
	}
	
	public function buildPlanAction () {	
		
	}
	
	public function searchPlansAction () {
		
	}
	
	public function viewPlanAction () {
		
	}
	
	public function viewResourceAction () {
		
	}
	
	public function editAccountAction () {
		
	}
}


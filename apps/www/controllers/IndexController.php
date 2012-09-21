<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->navActive = "";
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
		$this->view->navActive = "home";
	}
	
	public function buildPlanAction () {	
		$this->view->navActive = "build";
	}
	
	public function searchPlansAction () {
		$this->view->navActive = "search";
	}
	
	public function viewPlanAction () {
		
	}
	
	public function viewResourceAction () {
		
	}
	
	public function editAccountAction () {
		
	}
}


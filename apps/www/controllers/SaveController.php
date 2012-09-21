<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->_helper->viewRenderer->setNoRender();
    	// $this->_helper->layout()->disableLayout();
    }

    public function indexAction()
    {
    	$thingRepo = new repo\ThingRepo($this->_reachitRepoUri);
		if ($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$thing = json_decode($data);
			$thingRepo->save($thing);
		}

    }
    
}
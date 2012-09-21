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
        $query = $this->getRequest()->getParam("query");
        $count = $this->getRequest()->getParam("count");
        $toomit = $this->getRequest()->getParam("toomit");
        $count = (empty($count)) ? 10 : $count;
        $resourcesRepo = new LRRepo\ResourceRepo("https://node01.public.learningregistry.net");
        
        echo json_encode($resourcesRepo->getReducedArrayOfResources($query, $count, $toomit));

    }
    
}
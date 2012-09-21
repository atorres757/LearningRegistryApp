<?php


class PlanController extends Zend_Controller_Action
{

	protected $_reachitRepoUri;
	protected $_thePlan;
	
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender();
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		$this->_reachitRepoUri = $config->reachit->repodb;
		
	}
	
	public function SavePlanAction () {
		$planRepoVar = new repo\PlanRepo($this->_reachitRepoUri);
		if ($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$planRepoVar->save($plan);
		}	
	}
	
	public function SaveProfile () {
		$teacherRepoVar = new repo\TeacherRepo($this->_reachitRepoUri);
		if ($this->getRequest()->isPost()){
			$data = $this->getRequest()->getPost();
			$teacher = $teacherRepoVar->map($data);
			$teacherRepoVar->save($teacher);
		}
	}
	
	//Resource is saved as part of the Plan object (as a collection of tags/id/searchquery/what have you
// 	public function SaveResource () {
		
// 	}
	
	public function SavePlanComment () {
		$planCommentRepoVar = new repo\PlanCommentRepo($this->_reachitRepoUri);
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$comment = $planCommentRepoVar->map($data);
			$planCommentRepoVar->save($comment);
		}
	}
	
	public function SaveResourceComment () {
		$resourceCommentRepoVar = new repo\ResourceCommentRepo($this->_reachitRepoUri);
		if ($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$comment = $resourceCommentRepoVar->map($data);
			$resourceCommentRepoVar->save($comment);
		}
	}
	
}
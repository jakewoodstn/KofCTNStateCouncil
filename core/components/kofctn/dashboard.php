<?php
/**
* @package kofctn
*/
 
 class dashboard {
 
 	protected $_modx;

	
 	function __construct($modx){
 	
 	
		$this->_modx = $modx;
	
		$this->_modx->setDebug(E_ALL & ~E_NOTICE); // sets error_reporting to everything except NOTICE remarks
		$this->_modx->setLogLevel(modX::LOG_LEVEL_DEBUG);	

	
		require_once('dashboardComponent.php');
		require_once('dashboardParameters.php');
	}
	
	private function collapse($contentArray){
		$return = '';
		foreach ($contentArray as $key => $content) {
			$return.=$content;
		}

		return $return;
	}
	
	function getDashboard($region){
		$contentArray=array();
		$dp = new dashboardParameters($this->_modx,$this);

		if ($region == 'panel'){
		$this->_modx->log(modX::LOG_LEVEL_DEBUG, 'Hello World 1');
		    $contentArray = $this->getPanels($dp);
				$this->_modx->log(modX::LOG_LEVEL_DEBUG, 'Hello World 2');
		} elseif ($region =='gutter') {
			$contentArray = $this->getGutters($dp);
		}
		
		return $this->collapse($contentArray);
		
	}
	
	
	function getGutters($dp){
		$gutters = $this->_modx->getCollection('memberDashboardComponent',array("memberNumber"=>$this->_modx->user->username,"pageColumn"=>'gutter'));

		$dashgutters = array();
		
		foreach ($gutters as $gutter) {
			$dc = new dashboardComponent($this->_modx);
			$dp->addPanelAttributes($gutter);
			$dashgutters[]=$dc->render($gutter->componentChunkName,$dp);
		}
		
		return $dashgutters;		
	}
	
	function getPanels($dp){
			$this->_modx->log(modX::LOG_LEVEL_DEBUG, 'Hello World 3');
		$panels = $this->_modx->getCollection('memberDashboardComponent',array("memberNumber"=>$this->_modx->user->username,"pageColumn"=>'panel'));
				$this->_modx->log(modX::LOG_LEVEL_DEBUG, 'Hello World 4');
		$dashpanels = array();
		$rendered = array();
		
		foreach ($panels as $panel) {
			if (! in_array($panel->componentChunkName,$rendered)){
				$dc = new dashboardComponent($this->_modx);
				$dp->addPanelAttributes($panel);
				$dashpanels[]=$dc->render($panel->componentChunkName,$dp);
				$rendered[]=$panel->componentChunkName;
			}
		}
		
		return $dashpanels;		
	}

}
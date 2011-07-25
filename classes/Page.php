<?php
class Page {

	//data members
	private $title;
	private $navArray;
	private $mainNav;
	private $footerNav;
	private $userNav = '';
	private $myid = FALSE;
	private $mySep = '';

//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
 public function __construct($title, $navArray){
	require 'Nav.php';

  	$this->title = $title;
  	$this->navArray = $navArray;
  	$this->setMainNav();
  	$this->setFooterNav();
  	$this->setUserNav($userType);
  	}

private function setMainNav() {
	$mainNav = ($this->navArray['main'] != '') ? $this->navArray['main'] : $this->navArray[0];
	$this->mainNav = new Nav($mainNav, TRUE, NULL);
}
private function setFooterNav() {
	$footerNav = ($this->navArray['footer'] != '') ? $this->navArray['footer'] : $this->mainNav->getValue();
	$this->footerNav = new Nav($footerNav, FALSE, '|');
}
private function setUserNav($userType) {
	$userNav = ($this->navArray[$userType] != '') ? $this->navArray[$userType] : $this->navArray['login'] ;
	$this->userNav = new Nav($userNav);
}

public function getTitle() {
	$title = strip_tags($this->title);
	return $title;
	}

public function getBodyId($pagename) {

	if (strpos($pagename, " ") != 0)
		$pagename = substr($pagename, 0, strpos($pagename, " "));
	$pagename = ($pagename =="") ? 'Default' : $pagename;
	return $pagename;
	}

public function getPageName($fn) {

	return $this->mainNav->getPageName($fn);
}

public function getFooterNav() {
	return $this->footerNav->getNav();
	}

public function getMainNav() {
	return $this->mainNav->getNav();
	}
public function getUserNav() {
	return $this->userNav->getNav();
	}

public function getOtherNav($navKey) {
	$nav = new Nav($this->navArray[$navKey]);
	return $nav->getNav();
	}



}
?>
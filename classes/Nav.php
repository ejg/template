<?php

class Nav {
	//data members
	private $navArray;
	private $hasId;
	private $sep;
	private $hasSep = FALSE;
	private $sepLI = '';


//////////////////////////////////////////////////////////////////
//constructor
/////////////////////////////////////////////////////////////////
 public function __construct($navArray, $hasId='FALSE', $sep=NULL ){

  	$this->navArray = $navArray;
  	$this->hasId = $hasId;
  	$this->setSep($sep);
  	}

private function setSep($sep) {
	if ($sep != NULL) {
		$this->hasSep = TRUE;
		$this->sepLI = ' <li class="seperator"> '.$sep.' </li>';
		}
	}

private function getSep() {
	return $this->sepLI;
	}

 public function getValue() {

	return $this->navArray;
	}

 public function getNav() {

	$list = "";
	if ($this->navArray != "") {
		foreach ($this->navArray as $key => $value) {
			if (is_string($value)) {
				$list .= "<li{$this->getKeyLink($key)}><a href=\"{$key}\">{$value}</a></li>{$this->getSep()}\n";
			}
			else {
				$s = new Nav($value);
				$n = $s->getNav();
				$list .= "<li{$this->getKeyLink($key)}><a>{$key}</a><ul>{$n}</ul></li>\n";
			}
			}}
	if ($this->hasSep) {
		$list = substr($list,0,-30);
		}
	return $list;
	}

public function getPageName($fn) {
	$name = strip_tags($this->navArray[$fn]);

	return $name;
}
private function getKeyLink($key) {
	if ($this->hasId) {
		$dir = strpos($key, "/");
		if ($dir != 0) {
			$key = substr($key,$dir+1);
			}
		$key = str_replace("+","",$key);
		$last = strpos($key, ".");
		$last = ($last) ? $last : strlen($key);
		$myKey = substr($key,0,$last) . "Link";
		$myId = " id=\"{$myKey}\"";
	}
	return $myId;
	}

}
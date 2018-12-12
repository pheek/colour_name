<?php
// ⓒ  2018 phi@gress.ly

class TPL_Credentials {
	public $hostname = 'localhost';
	public $username = 'coloresV4';  // CHANGE IN REAL WORLD!
	public $password = '123';        // CHANGE IN REAL WORLD!
	public $dbname   = 'farbnamen';

	function getUsername() {
		return $this->username;
	}
	function getHostname() {
		return $this->hostname;
	}
	function getPassword() {
		return $this->password;
	}
	function getDBName() {
		return $this->dbname;
	}
}

// use as singleton:
global $TPL_CREDENTIALS;
if(!isset ($TPL_CREDENTIALS)) {
	$TPL_CREDENTIALS = new TPL_Credentials();
}

 ?>
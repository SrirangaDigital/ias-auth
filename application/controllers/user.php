<?php

class user extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function login() {

		$this->view('user/login');
	}
}

?>

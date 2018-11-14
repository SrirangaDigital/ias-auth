<?php

class user extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function testSession() {

		var_dump($_SESSION);
	}
	
	public function login($query = [], $type = '') {

		$returnUrl = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;

		$data['type'] = $type;
		$data['returnUrl'] = $returnUrl;
		$this->view('user/login', $data);
	}

	public function logout($query = []) {

		$data['returnUrl'] = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;

		$this->view('user/logout', $data);
	}

	public function resetPassword() {

		$this->view('user/resetPasswordEmail');
	}

	public function getResetPassword($query = []) {

		if(!isset($query['s']) || !isset($query['t'])) { $this->view('error/blah'); return;}

		$data['selector'] = $query['s'];
		$data['token'] = $query['t'];

		$this->view('user/getResetPassword', $data);
	}
}

?>

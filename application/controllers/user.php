<?php

class user extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function login($query = [], $type = '') {

		$returnUrl = isset($query['returnUrl']) ? $query['returnUrl'] : DEFAULT_RETURN_URL;

		if($this->auth->isLoggedIn()){

			$this->absoluteRedirect($returnUrl);
		}

		$data['type'] = $type;
		$data['returnUrl'] = $returnUrl;
		$this->view('user/login', $data);
	}

	public function logout() {

		try {
		    $this->auth->logOutEverywhere();
			$this->absoluteRedirect('https://google.com/');
		}
		catch (\Delight\Auth\NotLoggedInException $e) {

		    echo 'Not logged in';
		}
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

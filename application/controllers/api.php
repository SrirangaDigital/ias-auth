<?php

class api extends Controller {

	public function __construct() {
	
		parent::__construct();
	}

	public function login() {

		$postData = $this->model->getPostData();

		try {

		    $this->auth->loginWithUsername($postData['username'], $postData['password']);

		    $this->model->loadSessionVariables($postData);
    		$_SESSION['auth_roles_assigned'] = $this->auth->getRoles();

		    echo($postData['returnUrl']);
		}
		catch (\Delight\Auth\UnknownUsernameException $e) {
		    
		    echo('unknown username');
		}
		// catch (\Delight\Auth\InvalidEmailException $e) {
		    
		//     echo('wrong email address');
		// }
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    
		    echo('wrong password');
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    
		    echo('email not verified');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    
		    echo('too many requests');
		}
	}

	public function initiateResetPassword() {

		$postData = $this->model->getPostData();

		try {
		    $this->auth->forgotPassword($postData['email'], function ($selector, $token) {
				
				// Send mail		        
		        echo (BASE_URL . 'user/getResetPassword?s=' . $selector . '&t=' . $token);
		    });
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo ('invalid email address');
		}
		catch (\Delight\Auth\EmailNotVerifiedException $e) {
		    echo ('email not verified');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('too many requests');
		}
	}

	public function confirmResetPasswordValidity() {

		$getData = $this->model->getGETData();

		try {
		    $this->auth->canResetPasswordOrThrow($getData['s'], $getData['t']);

		    echo SUCCESS_PHRASE;
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    echo ('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    echo ('token expired');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('too many requests');
		}
	}

	public function resetPassword() {

		$postData = $this->model->getPostData();
		if($postData['password'] != $postData['confirmPassword']) { echo "Passwords Don't Match"; return; }

		try {
		    $this->auth->resetPassword($postData['selector'], $postData['token'], $postData['password']);

		    echo SUCCESS_PHRASE;
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    echo ('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    echo ('token expired');
		}
		catch (\Delight\Auth\ResetDisabledException $e) {
		    echo ('password reset is disabled');
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo ('invalid password');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    echo ('too many requests');
		}
	}

	public function registerAll() {

		try {
		    $userId = $this->auth->admin()->createUserWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo 'invalid email address';
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo 'invalid password';
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    echo 'user already exists';
		}
		catch (\Delight\Auth\DuplicateUsernameException $e) {
		    echo 'username not unique';
		}
	}

	public function createAdmin() {

		$adminEmail = 'admin@ias.ac.in';

		try {
		    $userId = $this->auth->admin()->createUserWithUniqueUsername($adminEmail, 'xxx', 'admin');
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo 'invalid email address';
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo 'invalid password';
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    echo 'user already exists';
		}
		catch (\Delight\Auth\DuplicateUsernameException $e) {
		    echo 'username not unique';
		}

		try {
		    $this->auth->admin()->addRoleForUserByEmail($adminEmail, \Delight\Auth\Role::ADMIN);
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    die('Unknown email address');
		}

		// try {
		//     $this->auth->admin()->deleteUserByEmail($adminEmail);
		// }
		// catch (\Delight\Auth\InvalidEmailException $e) {
		//     die('Unknown email address');
		// }
	}

	public function confirmEmail() {

		$selector = 'v4NBLJuEHRuyXDvU';
		$token = "6MbPmChc_LrYpX9d";

		try {
		    $this->auth->confirmEmail($selector, $token);

		    echo('email address has been verified');
		}
		catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
		    
		    echo('invalid token');
		}
		catch (\Delight\Auth\TokenExpiredException $e) {
		    
		    echo('token expired');
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    
		    echo('email address already exists');
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    
		    echo('too many requests');
		}
	}

	public function logout() {

		try {
		    $this->auth->logOutEverywhere();
		    $this->auth->destroySession();
		}
		catch (\Delight\Auth\NotLoggedInException $e) {

		    echo 'Not logged in';
		}
	}

	public function check() {

		$email = 'arjun.kashyap1@yahoo.co.in';
		$password = 'test123';
		$username = 'arjunkashyap1';

		try {
		    // $userId = $this->auth->admin()->createUser($email, $password, $username);

			$emailID = $this->auth->getEmail();
			echo $emailID;

			$this->auth->changeEmail('arjun.kashyap@srirangadigital.com', function ($selector, $token) {

				var_dump($selector);
				var_dump($token);
	            // send `$selector` and `$token` to the user (e.g. via email to the *new* address)
	        });


		    // echo('we have signed up a new user with the ID ' . $userId);
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    echo 'invalid email address';
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    echo 'invalid password';
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    echo 'user already exists';
		}

		// var_dump($this->auth->admin()->getRolesForUserById('1'));
	}
}

?>

<?php

class api extends Controller {

	public function __construct() {
	
		$this->db = new Database();
		$this->dbh = $this->db->connect(DB_NAME);
		$this->auth = new \Delight\Auth\Auth($this->dbh);

		parent::__construct();
	}

	public function login() {

		$data = $this->model->getPostData();

		$email = $data['email'];
		$password = $data['password'];
		// $username = $data['username'];

		// $email = 'arjun.kashyap1@yahoo.co.in';
		// $password = 'test123';
		// $username = 'arjunkashyap';

		try {
		    $this->auth->login($email, $password);

		    echo('https://www.ias.ac.in/');
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    
		    echo('wrong email address');
		}
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

	public function register() {

		$email = 'arjun.kashyap@yahoo.co.in';
		$password = 'test123';
		$username = 'arjunkashyap';

		try {
		    $userId = $this->auth->register($email, $password, $username, function ($selector, $token) {
		        
		        var_dump($selector);
		        var_dump($token);
		        // send `$selector` and `$token` to the user (e.g. via email)
		    });

		    var_dump($userId);
		    // we have signed up a new user with the ID `$userId`
		}
		catch (\Delight\Auth\InvalidEmailException $e) {
		    // invalid email address
		}
		catch (\Delight\Auth\InvalidPasswordException $e) {
		    // invalid password
		}
		catch (\Delight\Auth\UserAlreadyExistsException $e) {
		    // user already exists
		}
		catch (\Delight\Auth\TooManyRequestsException $e) {
		    // too many requests
		}
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

		$this->auth->logOut();
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

<?php
/**
 * User - A Class that handles login register of all account types.
 * Provides functionality depending on what type of user is logged in, such as change password/email
 *
 * @author		Author: Mark Ellis
 * @git 		https://github.com/
 */
 
	class User {
		//Variables
		private $_db;
		private $username;
		private $email;
		private $is_logged = false;
		private $msg = array();
		private $error = array();
		
		//Class constructor 
		public
		function __construct(DB $db){
			//Uses the Db.class
			$this->_db = $db;
		}

		//Method to get the username
		public
		function get_username() {
			return $this->username;
		}

		//Method to get the email
		public
		function get_email() {
			return $this->email;
		}

		//Method to check if the user is logged
		public
		function is_logged() {
			return $this->is_logged;
		}

		//Method to get info messages
		public
		function get_info() {
			return $this->msg;
		}

		//Method to get errors
		public
		function get_error() {
			return $this->error;
		}
		
			//Method to display info
		public
		function display_info() {
			//Iterates msg
			foreach ($this->msg as $msg) {
				//Output msg
				echo '<p class="msg">' . $msg . '</p>';
			}
		}

		//Method to display errors
		public
		function display_errors() {
			//Iterates error 
			foreach ($this->error as $error) {
				//Output errors
				echo '<p class="error">' . $error . '</p>';
			}
		}
		
		//Method to get all users
		public
		function get_all_users() {
			//Querys to select all from users
			$query = 'SELECT * FROM users';
			//Runs query and stores in $result
			$result = $this->_db->query($query);
			//Returns $result
			return ($result->num_rows === 0);
		}

		//Function to clean, trim and sanitize
		public
		function clean_string($string){
			$string = trim($string);
			$string = filter_var($string, FILTER_SANITIZE_STRING);
			return $string;
		}

		//Function to escape output
		public
		function escape_output($string){
			return htmlentities($string,ENT_QUOTES,'UTF-8');
		}
		
	    //Method to generate random password
		public
		function generatePassword($length = 8){
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$count = mb_strlen($chars);
			for ($i = 0, $result = ''; $i < $length; $i++) {
				$index = rand(0, $count - 1);
				$result .= mb_substr($chars, $index, 1);
			}
			return $result;
		}

		//Method to register user
		public
		function registerUser() {
			//Checks if register form has been submitted
			if (isset($_POST['register'])){
				//Checks if the fields are set and not empty
				if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['confirm']) && !empty($_POST['email'])){
				    
				    
					//Checks if password is equal to confirm
					if ($_POST['password'] == $_POST['confirm']) {
						//Sets $first_user to empty_db();
						$first_user = $this->get_all_users();
						//Variables for $_POST
						$email = $_POST['email'];
						$username = $_POST['username'];
						$password = sha1($_POST['password']);
						$firstname = $_POST['firstname'];
						$lastname = $_POST['lastname'];
						//Escape output
						$email = $this->escape_output($email);
						$username = $this->escape_output($username);
						$password = $this->escape_output($password);
						$firstname = $this->escape_output($firstname);
						$lastname = $this->escape_output($lastname);
						//Clean string
						$firstname = $this->clean_string($firstname);
						$lastname = $this->clean_string($lastname);
						$email = $this->clean_string($email);
						$username = $this->clean_string($username);
						$password = $this->clean_string($password);
						//Creates the query to register the user into the database and runs the query
					//	$this->_db->query('SELECT * username FROM users WHERE username = "'.$username.'" ');
						if ($row = $this->_db->query('SELECT username FROM users WHERE username = "'.$username.'" ')){
						    $this->error[] = 'Username already exists';
						   
						} 
						if ($row = $this->_db->query('SELECT email FROM users WHERE email = "'.$email.'"')){
					    $this->error[] = 'Email already exists';
					    }
						else {
						$this->_db->query('INSERT INTO users (username, password, email, firstname, lastname) VALUES ("'.$username.'", "'.$password.'","'.$email.'", "'.$firstname.'","'.$lastname.'")');
						
							$this->msg[] = 'Registration Successful.';
					
						}
						//Checks if $first_user is true
						if($first_user) {
							//Updates the current session id with a newly generated one
							session_regenerate_id();
							//$_SESSION variables
							$_SESSION['id'] = session_id();
							$_SESSION['username'] = $username;
							$_SESSION['email'] = $email;
						//	$_SESSION['firstname'] = $firstname;
						//	$_SESSION['lastname'] = $lastname;
							$_SESSION['is_logged'] = true;
							//Sets is_logged to true
							$this->is_logged = true;
						} else {
							//$_SESSION variable for msg
							$_SESSION['msg'] = $this->msg;
						}
					
					}
					else {
						//Error message
						$this->error[] = 'Password don\'t match.';
					}
				}
				//Checks if the fields are empty
				elseif (empty($_POST['username']) && empty($_POST['password']) && empty($_POST['email']) && empty($_POST['confirm']) && empty($_POST['firstname']) && empty($_POST['lastname'])) {
					//Error message
					$this->error[] = 'Please fill in all fields.';
				}
				//Checks if the field is empty
				elseif (empty($_POST['username'])) {
					//Error message
					$this->error[] = 'Username field was empty.';
				}
				//Checks if the field is empty
				elseif  (empty($_POST['password'])) {
					//Error message
					$this->error[] = 'Password field was empty.';
				}
				//Checks if the field is empty
				elseif (empty($_POST['confirm'])) {
					//Error message
					$this->error[] = 'You need to confirm the password';
				}
				else if (empty($_POST['firstname'])){
				    $this->error[] = 'Firstname field was empty';
				}
				
				else if (empty($_POST['lastname'])){
				    $this->error[] = 'Lastname field was empty';
				}
				   
				
			}
		}
		
		//Method to add student user
		public
		function addStudent(){
			//Checks if the add student form is submitted
			if (isset($_POST['addStudent'])){
				//Checks if the fields are set and not empty
				if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
					//if ($_POST['password'] == $_POST['confirm']) { bang a c number finder in here
					//Stores $_POST
					$username = $_POST['username'];
					$email = $_POST['email'];
					$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					
					//Generates a random password
					$password = $this->generatePassword();
					//Stores random password
					$random = $password;
					//Converts password to sha1
					$password = sha1($password);
					//Stores $_POST
					$email = $_POST['email'];
					
					//Escape output
					$email = $this->escape_output($email);
					$username = $this->escape_output($username);
					$password = $this->escape_output($password);
					$firstname = $this->escape_output($firstname);
					$lastname = $this->escape_output($lastname);
					//Clean string
					$firstname = $this->clean_string($firstname);
					$lastname = $this->clean_string($lastname);
					$email = $this->clean_string($email);
					$username = $this->clean_string($username);
					$password = $this->clean_string($password);
					
					if ($row = $this->_db->query('SELECT username FROM users WHERE username = "'.$username.'" ')){
						$this->error[] = 'Username already exists';
					}
					if ($row = $this->_db->query('SELECT email FROM users WHERE email = "'.$email.'"')){
					    $this->error[] = 'Email already exists';
					}
					else {
					//Creates the query to insert user into the database and runs the query
					$this->_db->query('INSERT INTO users (username, password, email, firstname, lastname, type) VALUES ("'.$username.'", "'.$password.'","'.$email.'", "'.$firstname.'", "'.$lastname.'", "2")');
					//Success message
					$this->msg[] = 'Student Added.';
					$this->msg[] = $random;
					/* Emails the password to the Student */
					//Puts the hosts email in a variable
					$to = $email;
					//Puts the users email in a variable
					$from =  "m.ellis@valadan.co.uk";
					//Creates the email content and also a copy for the host
					$subject = "Prototype: Your student login.";
					$subject2 = "Copy of your form submission";
					$message1 = $username . " Here is your password:" . "\n\n" . $random;
					$message2 = "Here is a copy of your message " . $username . "\n\n" . $random;
					$headers = "From:" . $from;
					$headers2 = "From:" . $to;
					//Sends a email to the host with a copy of the email to the user
					mail($to,$subject,$message1,$headers);
					//Sends a email to the user
					mail($from,$subject2,$message2,$headers2);
					//Success message
					$this->msg[] = 'Email sent to Student';
					 }
				} else $this->error[] = 'Please fill in all fields.';
				//Error message
			}
		}

		//Method to login user
		public
		function userLogin() {
			//Checks if login form is submitted
			
			if (isset($_POST['login'])){
				//Checks if the fields are set and not empty
				
				if (isset($_POST['username']) && isset($_POST['password'])){
					
					if (!empty($_POST['username']) && !empty($_POST['password'])) {
						//Stores $_POST
						$this->username = $_POST['username'];
						$this->password = sha1($_POST['password']);
						//Escape output
						$this->username = $this->escape_output($this->username);
						$this->password = $this->escape_output($this->password);
						//Clean string
						$this->username = $this->clean_string($this->username);
						$this->password = $this->clean_string($this->password);
						// if ($row = $this->verify_password()) {
						//Checks if $row is equal to the created query to select from users depending on user input
						if ($row = $this->_db->query('SELECT * FROM users WHERE username="'.$this->username.'" AND password = "'.$this->password.'"')){
							//Updates the current session id with a newly generated one
							session_regenerate_id(true);
							//Stores $_SESSION variables
							$_SESSION['id'] = session_id();
							$_SESSION['username'] = $this->username;
							//Creates the query to select type from users depending on username and password and runs the query storing the result in $result
							$result = $this->_db->query('SELECT type, email, firstname, lastname FROM users WHERE username="'.$this->username.'" AND password = "'.$this->password.'"');
							//Iterates $result as $row
							foreach ($result as $row){
								//Stores type in session variable
								$_SESSION['type'] = $row['type'];
								$_SESSION['email'] = $row['email'];
								$_SESSION['firstname'] = $row['firstname'];
								$_SESSION['lastname'] = $row['lastname'];
							}
							//Sets $_SESSION['is_logged'] variable to true
							$_SESSION['is_logged'] = true;
							//Sets is_logged to true;
							$this->is_logged = true;
							//If is_logged is true displays success messages
							if($this->is_logged = true){
								echo '<meta http-equiv="refresh" content= "0;URL=images.php" />';
							}
						} else $this->error[] = 'Wrong username or password.';
						//Error message
					} else $this->error[] = 'Please fill in all fields.';
					//Error message
				}
			}
		}

		//Method to update user email
		public
		function updateEmail($username){
			//Checks if update email form is submitted
			if (isset($_POST['updateEmail'])){
				//Checks if fields are set and not empty
				if (isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] !== $_POST['old_email']) {
					//Stores $_POST
					$this->email = $_POST['email'];
					//Creates the query to update user email in the database and runs the query
					$this->_db->query('UPDATE users SET email ="'.$this->email.'" WHERE username = "'.$username.'"');
					//Success message
					$this->msg[] = 'Your email has been changed';
				} else $this->error[] = 'Please enter an email.';
				// Error message
			}
		}

		//Method to update user password
		public
		function updatePassword($username){
			//Checks if update password form is submitted
			if(isset($_POST['updatePassword'])){
				//Checks if fields are set and not empty
				if (isset($_POST['password']) && isset($_POST['newpassword1']) && isset($_POST['newpassword2']) && !empty($_POST['password']) && !empty($_POST['newpassword1']) && !empty($_POST['newpassword2'])) {
					//Checks if fields are equal to each other
					if ($_POST['newpassword1'] == $_POST['newpassword2']) {
						//Stores $_POST
						$this->password = sha1($_POST['password']);
						//Creates the query to select all from users in the database depending on user input and runs the query
						$this->_db->query('SELECT * FROM users WHERE username="'.$this->username.'" AND password = "'.$this->password.'"');
						//Stores $_POST
						$this->password = sha1($_POST['newpassword1']);
						//Creates the query to update user password in the database and runs the query
						$this->_db->query('UPDATE users SET password="'.$this->password.'" WHERE username = "'.$username.'"');
						//Success message
						$this->msg[] = 'Your password has been changed successfully';
					} else $this->error[] = 'Passwords don\t match.';
					// Error message
				}

				//Checks if the old password field is empty else 
				if (empty($_POST['password']) && (!empty($_POST['newpassword1']) || !empty($_POST['newpassword2']))){
					$this->error[] = 'Old password field was empty.';
					//Error message
				}

				//Checks if the new password field is empty else 
				if (!empty($_POST['password']) && empty($_POST['newpassword1'])){
					$this->error[] = 'New password field was empty.';
					//Error message
				}

				//Checks if the newpassword2 field is empty else 
				if (!empty($_POST['password']) && empty($_POST['newpassword2'])) {
					$this->error[] = 'You must enter the new password again.';
					//Error message
				}

				//Checks if all password fields are empty else 
				if (empty($_POST['password']) && (empty($_POST['newpassword1']) && empty($_POST['newpassword2']))){
					$this->error[] = 'Please fill in all fields.';
					//Error message
				}
				//Session variables
				$_SESSION['msg'] = $this->msg;
				$_SESSION['error'] = $this->error;
			}
		}
		
		//Method to delete user add moar
		public
		function deleteUser() {
			$this->_db->query('DELETE FROM users WHERE userid= "'.$userid.'"');
		}
		
		//Method to logout user
		public
		function logout() {
			//Unsets session
			session_unset();
			session_unset($_SESSION['cart']);
			//Destroys session
			session_destroy();
			//Sets is_logged to false
			$this->is_logged = false;
				echo '<meta http-equiv="refresh" content= "0;URL=images.php" />';
		}
	}

	?>
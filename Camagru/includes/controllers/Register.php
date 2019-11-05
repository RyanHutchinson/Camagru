<?php
class Register extends Controller{
	
/******************************************************************************/
/*****************************REGISTER & SET SESSION***************************/
/******************************************************************************/

	private function camaRegister($username, $firstname, $lastname, $email, $password, $passwordValidator) {

	/***************checking user inputs***************************************/

		if (empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordValidator)) {//inputs not empty?
			//------------------------------------------------------------------any empty fields?
			return ('
			<div style="padding-top:10px; color: red"> 
			<p>* All fields must be filled in!! *</p>
			</div>
			');
		}else if($password !== $passwordValidator){//---------------------------input missmatch?
			return ('
			<div style="padding-top:10px; color: red"> 
			<p>* Both Password fields must match! *</p>
			</div>
			');
		}
				
		$user_data = self::query('SELECT * FROM users WHERE Username=? OR Email=?;', array($username, $email));//get user data
		$user_data = $user_data[0];//-------------------------------------------fetchall() referencing issue //TODO:have a think about this

	/****************checking that there are no user conflicts*****************/

		if (!strcmp($user_data['Email'], $email)){//----------------------------conflicting email?
			return ('
			<div style="padding-top:10px; color: red">
			<p>email address already in use!</p>
			</div>');
		}else if(!strcmp($user_data['Username'], $username)){//-----------------conflicting username?
			return ('
			<div style="padding-top:10px; color: red">
			<p>* username already in use! *</p>
			</div>
			');
		}else{//----------------------------------------------------------------nope. all is gravey :)

	/***********Sending verimail and inserting user****************************/

			$token = self::tokeniser();
			$error = self::emailVerify($email, $token);//-----------------------sending verification email using unique token
			
			if(!$error){//------------------------------------------------------all good with sending email? if so insert user
				$pwhash = password_hash($password, PASSWORD_BCRYPT);
				self::query('INSERT INTO `users` (`Username`, `FirstName`, `LastName`, `Email`, `HashedPassword`, `Membertype`, `Token`)
				VALUES(?, ?, ?, ?, ?, ?, ?)',
				array($username, $firstname, $lastname, $email, $pwhash, 0, $token));
			}else{//------------------------------------------------------------all bad. return error
				return('
				<div style="padding-top:10px; color: red">
				<p>Failed to send email to</p>
				<p>*' . $email . '*</p>
				</div>
				');
			}

			$_SESSION['user'] = $username;//------------------------------------set that session!
		}
	}

/******************************************************************************/
/*****************************ENTRY POINT / FORM PRINTER***********************/
/******************************************************************************/

	public static function loadRegister(){
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])){//-----------User has registered?
			echo '<p>You have been registered!</p>
				<p>A verification email has been sent.</p>
				<p>This page will redirect in 5 seconds.</p>
				';
			header("refresh:5;url=" . Route::getDestination('Profile'));
		}else{//----------------------------------------------------------------If not print form.
			echo '
			<form method="POST" class="registerForm">
				<div style="padding-bottom: 10px">
					<input type="text" placeholder="Username" name="username">
				</div>
				<div>
					<input type="text" placeholder="First Name" name="firstname">
				</div>
				<div>
					<input type="text" placeholder="Last Name" name="lastname">
				</div>
				<div style="padding-top: 10px">
					<input type="email" placeholder="email" name="email">
				</div>
				<div style="padding-top: 10px">
					<input type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Password" name="password">
				</div>
				<div>
					<input type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="RE-enter Password" name="passwordValidator">
				</div>
				<div style="font-size: 10px; margin-top: 10px">
					<p>Please note:</p>
					<p>Passwords must contain at least 8 characters, one uppercase/lowercase letter, one number and one special charracter.</p>
				</div>
				<button type="submit" name="register" value="OK">Register</button>
			</form>
			<div style="padding-top: 25px">
				<div>
					<span>Already have an account?</span>
				</div>
				<div class="registerRedirect">
					<a href="' . Route::getDestination("Login", true) . '">Login</a>  
				</div>
			</div>
			';
			if ($_POST['register'] == 'OK') {//---------------------------------Button pressed?
				self::sanitizeInput();
				$error =  self::camaRegister($_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'] ,$_POST['password'], $_POST['passwordValidator']);

				if (!$error){//-------------------------------------------------is all good?
					header("Refresh:0");//120");
				}else{//--------------------------------------------------------if not print error.
					echo $error;
				}
			}
		}
	}
}
?>
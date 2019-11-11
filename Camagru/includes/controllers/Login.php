<?php
class Login extends Controller{

/******************************************************************************/
/********************************LOGIN AND SESSION SETTER**********************/
/******************************************************************************/

	private function camaLogin($username, $password) {

		if (empty($username) || empty($password)) {//---------------------------Return error string if any inputs are empty
			return ('
			<div style="padding-top:10px; color: red"> 
			<p>Please enter a Username & Password!</p>
			</div>
			');
		}

		$user_data = self::query('SELECT * FROM users WHERE Username=?;', array($username));//-Pulling user data

		if(password_verify($password, $user_data[0]['HashedPassword'])){//------do passwords match?
			$_SESSION['user'] = $username;//------------------------------------set that session
		}else{//----------------------------------------------------------------no match? return error.
			return ('
			<div style="padding-top:10px; color: red">
			<p>Invalid login credentials!</p>
			</div>
			');
		}
	}

/******************************************************************************/
/*****************************ENTRY POINT / FORM PRINTER***********************/
/******************************************************************************/

	public static function loginForm(){

		if (isset($_SESSION['user']) && !empty($_SESSION['user'])){//-----------is user already logged in?
			echo '<p>You are logged in!</p>';
			header("refresh:2;url=" . Route::getDestination('Profile'));
		}else{//----------------------------------------------------------------if not print form.
			echo '
			<form method="POST" class="loginForm">
				<div>
				<input type="text" placeholder="Username" name="user">
				</div>
				<div>
				<input title="1 Uppercase, 1 Lowercase, 1 Number, 1 Special Character...i.e. (!@#$%^&*)" type="password" placeholder="Password" name="passwd">
				</div>
				<button type="submit" name="login" value="OK">Login</button>
			</form>
			<div style="padding-top: 25px">
				<div>
					<span style="font-size: 12px">Not registered?  <a href="' . Route::getDestination("Register", true) . '">   Sign Up</a></span>
				</div>
                <div>
					<span style="font-size: 12px">Forgot password?  <a href="' . Route::getDestination("ForgotPassword", true) . '">   Click Here</a></span>
				</div>
			</div>
			';
			if ($_POST['login'] == 'OK') {//------------------------------------button pressed?
				$error =  self::camaLogin($_POST['user'], $_POST['passwd']);
				if (!$error){//-------------------------------------------------is all good?
					header("Refresh:0");
				}else{//--------------------------------------------------------if not all is bad T-T
					echo $error;
				}
			}
			if ($_SESSION['user'] == 'admin')
				header("Location: HOME_PATH");//TODO: Admin page stuff
		}
	}
}      
?>
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
				<input type="password" placeholder="Password" name="passwd">
				</div>
				<button type="submit" name="login" value="OK">Login</button>
			</form>
			<div style="padding-top: 25px">
				<div>
					<span>Not registered?</span>
				</div>
				<div class="registerRedirect">
					<a href="' . Route::getDestination("Register", true) . '">Sign Up</a>  
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
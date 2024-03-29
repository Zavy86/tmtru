<?php
/**
 * Authentication
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;
use TMTRU\Session;

require_once('../bootstrap.inc.php');

try{
	$loginFailed=false;
	$Session=new Session();
	$Configuration=new Configuration();
	$Session->logout();
	$password=$_REQUEST['password']??'';
	if(strlen($password)){
		if($Configuration->checkPasswordMatch($password)){
			$Session->login();
		}else{
			$loginFailed=true;
		}
		if($Session->isValid()){
			exit(header('Location: admin.php'));
		}
	}
}catch(Exception $Exception){
	if(DEBUG){
		var_dump($_REQUEST);
		var_dump($Configuration);
		var_dump($Session);
		//var_dump($Exception);
		throw $Exception;
	}
}

?>
<html>
	<head>
		<title><?php echo $Configuration->getTitle(); ?></title>
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	</head>
	<body>
		<div class="container">
			<img src="img/logo.png" alt="tmtru-logo" width="126">
			<h1><?php echo $Configuration->getTitle(); ?></h1>
			<p class="italic">"tell me the real url"</p>
			<br>
			<p>Authentication</p>
			<form action="authentication.php" method="post">
				<input type="password" name="password" placeholder="Password" autofocus/>
				<input type="submit" value="Login"/>
				<?php if($loginFailed){ ?><p id="alert" class="alert italic">login failed</p><?php } ?>
			</form>
		</div>
	</body>
</html>

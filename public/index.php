<?php
/**
 * Index
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;

require_once('../bootstrap.inc.php');

try{
	$Configuration=new Configuration();
}catch(Exception $Exception){
	if(DEBUG){
		var_dump($_REQUEST);
		if(isset($Configuration)){var_dump($Configuration);}
		//var_dump($Exception);
		throw $Exception;
		die();
	}
}

?>
<html>
	<head>
		<title><?php echo $Configuration->getTitle(); ?></title>
		<link rel="icon" type="image/x-icon" href="img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	</head>
	<body>
		<div class="container">
			<a href="/admin.php">
				<img src="img/logo.png" alt="tmtru-logo" width="126">
			</a>
			<h1><?php echo $Configuration->getTitle(); ?></h1>
			<p class="italic">"tell me the real url"</p>
		</div>
	</body>
</html>

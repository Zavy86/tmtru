<?php
/**
 * Administration
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;
use TMTRU\Session;

require_once('../bootstrap.inc.php');

try{
	$Session=new Session();
	$Configuration=new Configuration();
	if(!$Session->isValid()){
		exit(header('Location: authentication.php'));
	}
}catch(Exception $Exception){
	if(DEBUG){
		var_dump($Configuration);
		var_dump($Session);
		//var_dump($Exception);
		throw $Exception;
	}
}

$page=$_REQUEST['page']??'list';

?>
<html>
<head>
	<title><?php echo $Configuration->getTitle(); ?></title>
	<link rel="icon" type="image/x-icon" href="img/favicon.ico"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" href="css/bulma.min.css"/>
	<link rel="stylesheet" href="css/bulma-tagsinput.min.css"/>
</head>
<body>


	<nav class="navbar is-info" role="navigation" aria-label="main navigation">

		<div class="container is-fluid">

		<div class="navbar-brand">
			<a class="navbar-item" href="/">
				<img src="img/logo.png" alt="tmtru-logo" height="28">
			</a>

			<span class="navbar-item is-bold">
				<?php echo $Configuration->getTitle(); ?>
			</span>

			<div class="navbar-item">
				<a href="admin.php?page=edit" class="button is-light">
					New Link
				</a>
			</div>

			<a href="admin.php?page=list" class="navbar-item<?php if($page!="settings"){echo " is-active";}?>">
				Links
			</a>

			<a href="admin.php?page=settings" class="navbar-item<?php if($page=="settings"){echo " is-active";}?>">
				Settings
			</a>

		</div>

	</nav>

	<br>

	<div class="container is-fluid">

<?php
include('admin_'.$page.'.php');
?>

</div>
</body>
<script type="text/javascript" src="js/bulma-tagsinput.min.js"></script>
<script>BulmaTagsInput.attach();</script>
</html>

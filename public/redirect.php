<?php
/**
 * Link
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;
use TMTRU\Link;

require_once('../bootstrap.inc.php');

try{
	$linkUid=$_REQUEST['link']??'';
	$Configuration=new Configuration();
	$Link=new Link($linkUid);
	$Link->incrementClicks();
}catch(Exception $Exception){
	if(DEBUG){
		var_dump($_REQUEST);
		var_dump($Configuration);
		var_dump($Link);
		//var_dump($Exception);
		throw $Exception;
		die();
	}
	exit(header('Location: notfound.php?link='.$linkUid));
}

?>
<html>
	<head>
		<title>tmtru</title>
		<link rel="icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div>
			<img src="logo.png" alt="coordinator-engine-logo" width="126">
			<h1>tmtru</h1>
			<p>Redirecting to <strong><a href="<?php echo $Link->getURL(); ?>"><?php echo $Link->getURL(); ?></a></strong></p>
			<p id="dots">.</p>
			<p id="alert" class="hidden alert italic">if redirect doesn't work click the link</p>
		</div>
	</body>
</html>
<script>
  setInterval(function(){
    const dots=document.getElementById("dots");
    dots.textContent=dots.textContent+'.';
  },1000);
  setTimeout(function(){
    //window.location.href='<?php echo $Link->getURL(); ?>';
  },4000);
  setTimeout(function(){
    document.getElementById("alert").classList.remove("hidden");
  },9000);
</script>

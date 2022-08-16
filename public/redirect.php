<?php
/**
 * Redirect
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
}catch(Exception $Exception){
	if(DEBUG){
		var_dump($_REQUEST);
		if(isset($Configuration)){var_dump($Configuration);}
		if(isset($Link)){var_dump($Link);}
		//var_dump($Exception);
		throw $Exception;
		die();
	}
	exit(header('Location: notfound.php?link='.$linkUid));
}

?>
<html>
	<head>
		<title><?php echo $Link->getURL(); ?></title>
		<link rel="icon" type="image/x-icon" href="img/favicon.ico">
		<link rel="stylesheet" type="text/css" href="/css/style.css"/>
<?php if($Configuration->getGtag()){ ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $Configuration->getGtag(); ?>"></script>
		<script>
			window.dataLayer=window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js',new Date());
			gtag('config','<?php echo $Configuration->getGtag(); ?>');
		</script>
<?php } ?>
	</head>
	<body>
		<div class="container">
			<img src="img/logo.png" alt="coordinator-engine-logo" width="126">
			<h1>tmtru</h1>
			<p class="italic">"tell me the real url"</p>
			<br>
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
    if(<?php echo (DEBUG?'false':'true'); ?>){window.location.href='<?php echo $Link->getURL(); ?>';}
  },4000);
  setTimeout(function(){
    document.getElementById("alert").classList.remove("hidden");
  },9000);
</script>

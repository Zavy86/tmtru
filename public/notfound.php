<?php
/**
 * Not Found
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

$linkUid=$_REQUEST['link']??null;
//var_dump($_REQUEST);
//var_dump($linkUid);

?>
<html>
	<head>
		<title>tmtru</title>
		<link rel="icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<div class="container">
			<img src="logo.png" alt="coordinator-engine-logo" width="126">
			<h1>tmtru</h1>
			<p class="italic">"tell me the real url"</p>
			<br>
			<h2>Error 404</h2>
			<p>link <?php echo ($linkUid?'"'.$linkUid.'"':null); ?> was not found</p>
		</div>
	</body>
</html>

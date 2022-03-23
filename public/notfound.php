<?php
/**
 * Not Found
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

//var_dump($_REQUEST);
$linkUid=$_REQUEST['link']??null;
//var_dump($linkUid);

?>
<html>
	<head>
		<title>tmtru</title>
		<link rel="icon" type="image/x-icon" href="favicon.ico">
	</head>
	<body>
		<div>
			<img src="logo.png" alt="coordinator-engine-logo" width="126">
			<h1>tmtru</h1>
			<p class="italic">"tell me the real url"</p>
			<br>
			<h2>Error 404</h2>
			<p>link "<?php echo $linkUid; ?>" was not found</p>
		</div>
	</body>
</html>
<style>
	div{padding-top:99px;text-align:center;}
  h1{font-family:sans-serif;font-size:27px;}
  h2{font-family:sans-serif;font-size:21px;}
	p{font-family:sans-serif;font-size:18px;}
	.italic{font-style:italic;}
	.bold{font-weight:bolder;}
</style>
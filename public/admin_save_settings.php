<?php
/**
 * Administration - Save Settings
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Configuration;

$Configuration=new Configuration();
//var_dump($Configuration);

/** @todo cleans request inputs */

$length=intval($_REQUEST['length']??null);
$title=strval($_REQUEST['title']??null);
$owner=strval($_REQUEST['owner']??null);
$password=strval($_REQUEST['password']??null);
$debuggable=boolval($_REQUEST['debuggable']??false);

$Configuration->setDebuggable($debuggable);

try{

	if($length){$Configuration->setLength($length);}
	if($title){$Configuration->setTitle($title);}
	if($owner){$Configuration->setOwner($owner);}
	if($password){$Configuration->setPassword($password);}

	$Configuration->save();

	header('location: admin.php?page=settings&alert=updated');

}catch(Exception $Exception){
	if(DEBUG){
		var_dump($_REQUEST);
		var_dump($Configuration);
		throw $Exception;
	}else{
		header('location: admin.php?page=settings&alert=error');
	}
}

<?php
/**
 * Administration - Save Link
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

use TMTRU\Link;

//var_dump($_REQUEST);

$action=strval($_REQUEST['action']??null);
$uid=strval($_REQUEST['uid']??null);
$url=strval($_REQUEST['url']??null);
$description=strval($_REQUEST['description']??null);
$tags=(isset($_REQUEST['tags'])?explode(',',$_REQUEST['tags']):array());

if($action=="update"){

	if(!Link::exists($uid)){
		// errore uid non esistente
		die("errore uid non esistente");
	}

	$Link=new Link($uid);
	//var_dump($Link);

}else{

	$Link=new Link();
	//var_dump($Link);

	if(strlen($uid)){
		if(strlen($uid)<3){
			// errore uid troppo corto
			die("errore uid troppo corto");
		}
		if(Link::exists($uid)){
			// errore uid già esistente
			die("errore uid già esistente");
		}
		$Link->setUID($uid);
	}

}

if(!isset($url) || !str_starts_with($url,'http')){
	// errore url invalido
	die("errore url invalido");
}
$Link->setURL($url);

$Link->setDescription($description);

$Link->setTags($tags);

// try

//var_dump($Link);

$Link->save();

header('location: admin.php?link='.$Link->getUID());

?>
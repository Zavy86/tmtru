<?php
/**
 * Bootstrap
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */
error_reporting(E_ALL);
ini_set('display_errors',true);
define('DIR',str_replace(['/','\\'],DIRECTORY_SEPARATOR,__DIR__.'/'));
if(version_compare(PHP_VERSION,'8.0.0')<0){die('Required at least PHP version 8.0.0, current version: '.PHP_VERSION);}
spl_autoload_register(function ($class){
	if(strncmp('TMTRU\\',$class,strlen('TMTRU\\'))!==0){return;}
	$relative_class=substr($class,strlen('TMTRU\\'));
	$file=DIR.'src/'.str_replace('\\','/',$relative_class).'.php';
	if(file_exists($file)){require $file;}
	else{die('Error auto-loading class '.$class.'. File '.$file.' was not found');}
});
define('DEBUG',((new \TMTRU\Configuration())->isDebuggable() && (isset($_GET['debug']) && $_GET['debug']==1)));
ini_set('display_errors',DEBUG);

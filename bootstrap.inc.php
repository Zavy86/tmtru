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
require DIR.'vendor/autoload.php';
define('DEBUG',((new \TMTRU\Configuration())->isDebuggable() && (isset($_GET['debug']) && $_GET['debug']==1)));
ini_set('display_errors',DEBUG);
if(version_compare(PHP_VERSION,'8.1.0')<0){die('Required at least PHP version 8.1.0, current version: '.PHP_VERSION);}

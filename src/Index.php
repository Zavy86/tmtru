<?php
/**
 * Index
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU;

use TMTRU\Interfaces\IndexInterface;
use TMTRU\Exceptions\IndexException;

final class Index implements IndexInterface{

	/** @var Link[] $links  */
	protected array $links;

	public function __construct(){
		$this->load();
	}

	private function load():void{
		/** @todo implement cache */
		$this->links=array();
		$this->scanFiles($this->makeFilesPath());
		ksort($this->links);
	}

	private function makeFilesPath():string{
		$directory=DIR."links";
		if(!is_dir($directory)){mkdir($directory,0755,true);}
		return $directory;
	}

	private function scanFiles($directory):void{
		$items=scandir($directory);
		if($items===false){throw IndexException::directoryError($directory);}
		foreach($items as $item){
			if(in_array($item,array('.','..'))){continue;}
			if(is_dir($directory.DIRECTORY_SEPARATOR.$item)){
				$this->scanFiles($directory.DIRECTORY_SEPARATOR.$item);
			}else{
				if(!str_ends_with($item,'.json')){continue;}
				$linkUid=substr($item,0,-5);
				$Link=new Link($linkUid);
				$this->links[$linkUid]=$Link;
			}
		}
	}

	public function getLinks():array{
		return $this->links;
	}

	public function __debugInfo():?array{
		$result=array();
		foreach($this->links as $uid=>$Link){
			$result[$uid]=$Link->getURL();
		}
		return $result;
	}

}

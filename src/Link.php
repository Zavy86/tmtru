<?php
/**
 * Link
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU;

use TMTRU\Interfaces\LinkInterface;
use TMTRU\Exceptions\LinkException;

final class Link implements LinkInterface{

	protected string $uid;
	protected ?string $url=null;
	protected ?string $description=null;
	protected ?string $tags=null;
	protected int $created;
	protected ?int $updated=null;
	protected ?int $lastClick=null;
	protected int $clicks;

	public function __construct(?string $uid=null){
		if(is_null($uid)){
			$this->new();
		}else{
			$this->load($uid);
		}
	}

	private function new():void{
		$this->setUID($this->generateUID());
		$this->created=time();
		$this->clicks=0;
	}

	private function load(string $uid):void{
		$this->setUID($uid);
		$filePath=$this->makeFilePath();
		if(!file_exists($filePath)){throw LinkException::fileNotFound($filePath);}
		$data=file_get_contents($filePath);
		if($data===false){throw LinkException::fileReadingError();}
		$parameters=json_decode($data,true);
		if(!is_array($parameters)){throw LinkException::syntaxError();}
		foreach(array_keys(get_class_vars($this::class)) as $parameter){
			if(!isset($parameters[$parameter])){continue;}
			$this->$parameter=$parameters[$parameter];
		}
	}

	private function save():void{
		$filePath=$this->makeFilePath($this->uid);
		$fileContent=json_encode(get_object_vars($this),JSON_PRETTY_PRINT);
		$bytes=file_put_contents($filePath,$fileContent);
		if($bytes===false){throw LinkException::fileWritingError();}
	}

	private function makeFilePath():string{
		$directory=DIR."links".DIRECTORY_SEPARATOR.substr($this->uid,0,1);
		$file=$this->uid.".json";
		if(!is_dir($directory)){mkdir($directory,0755,true);}
		return $directory.DIRECTORY_SEPARATOR.$file;
	}

	private function generateUID():string{
		return substr(md5(time()),0,4); /** @todo ? creare classe specifica per generazione id con dimensione ecc.. */
	}

	public function setUID(string $uid):void{
		$this->uid=$uid;
	}

	public function getUID():string{
		return $this->uid;
	}

	public function getURL():?string{
		return $this->url;
	}

	public function getDescription():?string{
		return $this->description;
	}

	public function getTags():array{
		if(is_null($this->tags)){return array();}
		return explode(',',$this->tags);
	}

	public function getCreated():int{
		return $this->created;
	}

	public function getUpdated():?int{
		return $this->updated;
	}

	public function getLastClick():?int{
		return $this->lastClick;
	}

	public function getClicks():int{
		return $this->clicks;
	}

	public function incrementClicks():void{
		$this->clicks++;
		$this->save();
	}

	public function __debugInfo():?array{
		return array(
			'uid'=>$this->getUID(),
			'url'=>$this->getURL(),
			'description'=>$this->getDescription(),
			'tags'=>$this->getTags(),
			'created'=>$this->getCreated(),
			'updated'=>$this->getUpdated(),
			'lastClick'=>$this->getLastClick(),
			'clicks'=>$this->getClicks()
		);
	}

}

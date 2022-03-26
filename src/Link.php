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
	protected array $tags=array();
	protected int $created;
	protected ?int $updated=null;

	public function __construct(?string $uid=null){
		if(is_null($uid)){
			$this->new();
		}else{
			$this->load($uid);
		}
	}

	private function new():void{
		$this->setUID($this::generateUID());
		$this->created=time();
	}

	private function load(string $uid):void{
		$this->setUID($uid);
		$filePath=$this::makeFilePath($this->uid);
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

	public function save():void{
		$this->updated=time();
		$filePath=$this::makeFilePath($this->uid);
		$fileContent=json_encode(get_object_vars($this),JSON_PRETTY_PRINT);
		$bytes=file_put_contents($filePath,$fileContent);
		if($bytes===false){throw LinkException::fileWritingError();}
	}

	private static function makeFilePath(string $uid):string{
		$directory=DIR."links".DIRECTORY_SEPARATOR.substr($uid,0,2);
		$file=$uid.".json";
		if(!is_dir($directory)){mkdir($directory,0755,true);}
		return $directory.DIRECTORY_SEPARATOR.$file;
	}

	private static function generateUID(int $length=3):string{
		/** @todo ? creare classe specifica per generazione id con dimensione ecc.. */
		if($length>32){$length=32;}
		$chars=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r',
			           's','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
		do{
			$uid=implode(array_rand(array_flip($chars),$length));
		}while(Link::exists($uid));
		return $uid;
	}

	public static function calculatePossibles(int $length):int{
		$possibilities=1;
		for($i=0;$i<$length;$i++){
			$possibilities*=36;
		}
		return $possibilities;
	}

	public static function exists(string $uid):bool{
		return file_exists(Link::makeFilePath($uid));
	}

	public function setUID(string $uid):void{
		$this->uid=$uid;
	}

	public function setURL(string $url):void{
		$this->url=$url;
	}

	public function setDescription(?string $description):void{
		$this->description=$description;
	}

	public function setTags(array $tags):void{
		$this->tags=$tags;
	}

	public function addTags(string ...$tags):void{
		foreach($tags as $tag){
			if(!in_array($tag,$this->tags)){
				$this->tags[]=$tag;
			}
		}
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
		return $this->tags;
	}

	public function getCreated():int{
		return $this->created;
	}

	public function getUpdated():?int{
		return $this->updated;
	}

	public function __debugInfo():?array{
		return array(
			'uid'=>$this->getUID(),
			'url'=>$this->getURL(),
			'description'=>$this->getDescription(),
			'tags'=>$this->getTags(),
			'created'=>$this->getCreated(),
			'updated'=>$this->getUpdated()
		);
	}

}

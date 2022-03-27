<?php
/**
 * Configuration
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU;

use TMTRU\Interfaces\ConfigurationInterface;
use TMTRU\Exceptions\ConfigurationException;

final class Configuration implements ConfigurationInterface{

	private bool $debuggable;
	private int $length;
	private string $title;
	private string $owner;
	private string $password;
	private ?string $gTag;

	public function __construct(){
		$configurationFilePath=$this->makeConfigurationFilePath();
		if(!file_exists($configurationFilePath)){
			//throw ConfigurationException::configurationFileNotFound($configurationFilePath);
			$this->makeDefaultConfiguration();
		}else{
			$bytes=file_get_contents($configurationFilePath);
			$parameters=json_decode($bytes,true);
			if(!is_array($parameters)){throw ConfigurationException::configurationSyntaxError();}
			foreach(array_keys(get_class_vars($this::class)) as $parameter){
				if(!isset($parameters[$parameter])){throw ConfigurationException::configurationParameterNotFound($parameter);}
				$this->$parameter=$parameters[$parameter];
			}
		}
	}

	public function save():void{
		$fileContent=json_encode(get_object_vars($this),JSON_PRETTY_PRINT);
		$bytes=file_put_contents($this->makeConfigurationFilePath(),$fileContent);
		if($bytes===false){throw ConfigurationException::fileWritingError();}
	}

	private function makeConfigurationFilePath():string{
		return DIR.'configuration.json';
	}

	private function makeDefaultConfiguration(){
		$this->debuggable=false;
		$this->length=3;
		$this->title='TMTRU';
		$this->owner='Firstname Lastname';
		$this->password='password';
		$this->gTag='';
		$this->save();
	}

	public function isDebuggable():bool{
		return $this->debuggable;
	}

	public function getLength():int{
		return $this->length;
	}

	public function getTitle():string{
		return $this->title;
	}

	public function getOwner():string{
		return $this->owner;
	}

	public function getGtag():?string{
		return $this->gTag;
	}

	public function checkPasswordMatch(string $passwordToMatch):bool{
		return ($passwordToMatch===$this->password);
	}

	public function setDebuggable(bool $debuggable):void{
		$this->debuggable=$debuggable;
	}

	public function setLength(int $length):void{
		if($length>8){$length=8;}
		$this->length=$length;
	}

	public function setTitle(string $title):void{
		$this->title=$title;
	}

	public function setOwner(string $owner):void{
		$this->owner=$owner;
	}

	public function setPassword(string $password):void{
		if(strlen($password)<8){throw ConfigurationException::passwordComplexity();}
		$this->password=$password;
	}

	public function setGtag(string $gTag):void{
		$this->gTag=$gTag;
	}

	public function __debugInfo():?array{
		return array(
			'debuggable'=>$this->isDebuggable(),
			'length'=>$this->getLength(),
			'title'=>$this->getTitle(),
			'owner'=>$this->getOwner(),
			'gTag'=>$this->getGtag()
		);
	}

}

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

	protected bool $debuggable;
	protected string $title;
	protected string $owner;
	protected string $password;

	public function __construct(){
		$configurationFilePath=DIR."configuration.json";
		if(!file_exists($configurationFilePath)){throw ConfigurationException::configurationFileNotFound($configurationFilePath);}
		$bytes=file_get_contents($configurationFilePath);
		$parameters=json_decode($bytes,true);
		if(!is_array($parameters)){throw ConfigurationException::configurationSyntaxError();}
		foreach(array_keys(get_class_vars($this::class)) as $parameter){
			if(!isset($parameters[$parameter])){throw ConfigurationException::configurationParameterNotFound($parameter);}
			$this->$parameter=$parameters[$parameter];
		}
	}

	public function isDebuggable():bool{
		return $this->debuggable;
	}

	public function getTitle():string{
		return $this->title;
	}

	public function getOwner():string{
		return $this->owner;
	}

	public function checkPasswordMatch(string $passwordToMatch):bool{
		return ($passwordToMatch===$this->password);
	}

	public function __debugInfo():?array{
		return array(
			'debuggable'=>$this->isDebuggable(),
			'title'=>$this->getTitle(),
			'owner'=>$this->getOwner(),
			'password'=>$this->getPasswordMasked()
		);
	}

	private function getPasswordMasked():string{
		if(strlen($this->password)<=6){return "********";}
		return substr($this->password,0,2).str_repeat("*",(strlen($this->password)-4)).substr($this->password,-2);
	}

	/*public function get(string $property):mixed{
		if(!key_exists($property,get_class_vars($this::class))){throw ConfigurationException::propertyNotFound(static::class,$property);}
		return $this->$property;
	}*/

}

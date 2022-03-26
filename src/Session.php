<?php
/**
 * Session
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU;

use TMTRU\Interfaces\SessionInterface;
use TMTRU\Exceptions\SessionException;

final class Session implements SessionInterface{

	protected string $uid;
	protected int $authentication=0;

	public function __construct(){
		$this->start();
		$this->load();
	}

	private function start(){
		session_start();
		$this->uid=session_id();
	}

	private function restart():void{
		session_destroy();
		session_start();
		$this->uid=session_id();
		$this->authentication=0;
	}

	private function load():void{
		//var_dump($_SESSION);
		$this->authentication=$_SESSION['authentication']??0;
	}

	private function getAuthenticationTimestamp():int{
		return $this->authentication;
	}

	private function refresh():void{
		$this->authentication=time();
		$_SESSION['authentication']=$this->authentication;
	}

	public function isValid():bool{
		if((time()-$this->getAuthenticationTimestamp())<(60*60)){ // 1 hour
			$this->refresh();
			return true;
		}
		return false;
	}

	public function getUID():string{
		return $this->uid;
	}

	public function login():void{
		$this->refresh();
	}

	public function logout():void{
		$this->restart();
	}

}

<?php
/**
 * Configuration Interface
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Interfaces;

use TMTRU\Exceptions\ConfigurationException;

interface ConfigurationInterface{

	/**
	 * save configuration to file
	 */
	public function save():void;

	/**
	 * @return bool check if debug is enabled
	 */
	public function isDebuggable():bool;

	/**
	 * @return int configuration links length
	 */
	public function getLength():int;

	/**
	 * @return string configuration title
	 */
	public function getTitle():string;

	/**
	 * @return string configuration owner
	 */
	public function getOwner():string;

	/**
	 * @return string|null configuration google analytics tag
	 */
	public function getGtag():?string;

	/**
	 * @return bool check if given password match with configuration password
	 */
	public function checkPasswordMatch(string $passwordToMatch):bool;

	/**
	 * @param bool $debuggable debug enabled or disabled
	 */
	public function setDebuggable(bool $debuggable):void;

	/**
	 * @param int $length new links length
	 */
	public function setLength(int $length):void;

	/**
	 * @param string $title new title
	 */
	public function setTitle(string $title):void;

	/**
	 * @param string $owner new owner
	 */
	public function setOwner(string $owner):void;

	/**
	 * @param string $password new password
	 * @throws ConfigurationException
	 */
	public function setPassword(string $password):void;

	/**
	 * @param string $gTag new google analytics tag
	 */
	public function setGtag(string $gTag):void;

}

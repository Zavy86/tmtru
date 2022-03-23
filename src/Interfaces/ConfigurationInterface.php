<?php
/**
 * Configuration Interface
 *
 * @package tmtru
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace tmtru\Interfaces;

interface ConfigurationInterface{

	/**
	 * Check Debuggable
	 * @return bool configuration debuggable tootle
	 */
	public function isDebuggable():bool;

	/**
	 * Get Title
	 * @return string configuration title
	 */
	public function getTitle():string;

	/**
	 * Get Owner
	 * @return string configuration owner
	 */
	public function getOwner():string;

	/**
	 * Check Password Match
	 * @return bool check if given password match with configuration password
	 */
	public function checkPasswordMatch(string $passwordToMatch):bool;

}

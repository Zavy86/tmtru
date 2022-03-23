<?php
/**
 * Session Interface
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Interfaces;

interface SessionInterface{

	/**
	 * @return string|null Session uid
	 */
	public function getUID():?string;

	/**
	 * @return bool check if session is valid
	 */
	public function isValid():bool;

	/**
	 * Set session logged in
	 */
	public function login():void;

	/**
	 * Set session logged out
	 */
	public function logout():void;

}

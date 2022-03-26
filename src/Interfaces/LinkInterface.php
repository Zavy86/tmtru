<?php
/**
 * Link Interface
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Interfaces;

interface LinkInterface{

	/**
	 * @param string|null $uid link uid or null for new link
	 */
	public function __construct(?string $uid=null);

	/**
	 * save link to file
	 */
	public function save():void;

	/**
	 * @param int $length length to check
	 * @return int number of possibilities
	 */
	public static function calculatePossibles(int $length):int;

	/**
	 * @param string $uid link uid to check
	 * @return bool check if link exists
	 */
	public static function exists(string $uid):bool;

	/**
	 * @param string $uid link uid
	 */
	public function setUID(string $uid):void;

	/**
	 * @param string $url link url
	 */
	public function setURL(string $url):void;

	/**
	 * @param string|null $description link description
	 */
	public function setDescription(?string $description):void;

	/**
	 * @param array $tags link tags
	 */
	public function setTags(array $tags):void;

	/**
	 * @param string ...$tags link tags to add
	 */
	public function addTags(string ...$tags):void;

	/**
	 * @return string link uid
	 */
	public function getUID():string;

	/**
	 * @return string|null link url
	 */
	public function getURL():?string;

	/**
	 * @return string|null link description
	 */
	public function getDescription():?string;

	/**
	 * @return array of link tags
	 */
	public function getTags():array;

	/**
	 * @return int link created timestamp
	 */
	public function getCreated():int;

	/**
	 * @return int|null link updated timestamp
	 */
	public function getUpdated():?int;

}

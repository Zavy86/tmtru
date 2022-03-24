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

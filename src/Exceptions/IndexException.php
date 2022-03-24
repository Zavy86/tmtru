<?php
/**
 * Index Exception
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Exceptions;

final class IndexException extends \Exception{

	public const DIRECTORY_ERROR=101;
	public static function directoryError(string $directory):static{
		return new static('An error occurred while listing directory '.$directory.'.',static::DIRECTORY_ERROR);
	}

}

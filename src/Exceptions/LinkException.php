<?php
/**
 * Link Exception
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Exceptions;

final class LinkException extends \Exception{

	public const FILE_FILE_NOT_FOUND=101;
	public static function fileNotFound(string $LinkFilePath):static{
		return new static('Link file '.$LinkFilePath.' not exists.',static::FILE_FILE_NOT_FOUND);
	}

	public const FILE_READING_ERROR=102;
	public static function fileReadingError():static{
		return new static('Link reading error.',static::FILE_READING_ERROR);
	}

	public const FILE_WRITING_ERROR=103;
	public static function fileWritingError():static{
		return new static('Link writing error.',static::FILE_WRITING_ERROR);
	}

	public const SYNTAX_ERROR=201;
	public static function syntaxError():static{
		return new static('Link syntax error.',static::SYNTAX_ERROR);
	}

}

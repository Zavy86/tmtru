<?php
/**
 * Configuration Exception
 *
 * @package TMTRU
 * @author Manuel Zavatta <manuel.zavatta@gmail.com>
 */

namespace TMTRU\Exceptions;

final class ConfigurationException extends \Exception{

	public const FILE_NOT_FOUND=101;
	public static function configurationFileNotFound(string $configurationFilePath):static{
		return new static('Configuration file '.$configurationFilePath.' not exists.',ConfigurationException::FILE_NOT_FOUND);
	}

	public const FILE_WRITING_ERROR=102;
	public static function fileWritingError():static{
		return new static('Configuration file writing error.',ConfigurationException::FILE_WRITING_ERROR);
	}

	public const SYNTAX_ERROR=201;
	public static function configurationSyntaxError():static{
		return new static('Configuration syntax error.',ConfigurationException::SYNTAX_ERROR);
	}

	public const PARAMETER_NOT_FOUND=301;
	public static function configurationParameterNotFound(string $parameter):static{
		return new static('Expected parameter '.$parameter.' in configuration.',ConfigurationException::PARAMETER_NOT_FOUND);
	}

	public const PASSWORD_COMPLEXITY=401;
	public static function passwordComplexity():static{
		return new static('Insufficient password complexity.',ConfigurationException::PASSWORD_COMPLEXITY);
	}

}

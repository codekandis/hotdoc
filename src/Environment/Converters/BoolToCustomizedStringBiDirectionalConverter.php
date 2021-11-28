<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Environment\Converters;

use CodeKandis\Converters\AbstractConverter;
use CodeKandis\Converters\BiDirectionalConverterInterface;
use CodeKandis\Converters\Types\TypeDeterminator;
use CodeKandis\Converters\Types\ValidTypes;
use CodeKandis\Converters\Types\ValidValuesRegularExpressions;
use CodeKandis\RegularExpressions\RegularExpression;
use function count;
use function implode;
use function is_bool;
use function is_string;

/**
 * Represents a bi-directional converter converting between bool and a customized string.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class BoolToCustomizedStringBiDirectionalConverter extends AbstractConverter implements BiDirectionalConverterInterface
{
	/**
	 * Represents the error message if the amount of customized strings is invalid.
	 * @var string
	 */
	protected const ERROR_INVALID_CUSTOMIZED_STRING_COUNT = 'The amount of the customized strings is invalid. `%s` given but `%s` expected.';

	/**
	 * Represents the error message if the type of a customized string is invalid.
	 * @var string
	 */
	protected const ERROR_INVALID_CUSTOMIZED_STRING_TYPE = 'The type of the customized string at index `%s` is invalid. `%s` given but `string` expected.';

	/**
	 * Stores the customized strings.
	 * @var array
	 */
	private array $customizedStrings;

	/**
	 * Constructor method.
	 * @param array $customizedStrings The customized strings.
	 * @throw InvalidCustomizedStringsException The amount of the customized string is invalid.
	 * @throw InvalidCustomizedStringsException The type of a customized string is invalid..
	 */
	public function __construct( array $customizedStrings )
	{
		$this->guardCustomizedStrings( $customizedStrings );

		$this->customizedStrings = $customizedStrings;
	}

	/**
	 * Determines if the customized strings are valid.
	 * @param array $customizedStrings The customized strings are valid.
	 * @throw InvalidCustomizedStringsException The amount of the customized string is invalid.
	 * @throw InvalidCustomizedStringsException The type of a customized string is invalid..
	 */
	private function guardCustomizedStrings( array $customizedStrings ): void
	{
		if ( 2 !== $customizedStringsCount = count( $customizedStrings ) )
		{
			throw new InvalidCustomizedStringsException(
				sprintf(
					static::ERROR_INVALID_CUSTOMIZED_STRING_COUNT,
					$customizedStringsCount,
					2
				)
			);
		}

		foreach ( $customizedStrings as $customizedStringIndex => $customizedString )
		{
			if ( false === is_string( $customizedString ) )
			{
				throw new InvalidCustomizedStringsException(
					sprintf(
						static::ERROR_INVALID_CUSTOMIZED_STRING_TYPE,
						$customizedStringIndex,
						( new TypeDeterminator( false ) )
							->determine( $customizedString )
					)
				);
			}
		}
	}

	/**
	 * Converts from a bool into a customized string value.
	 * @param bool $value The bool value which has to be converted.
	 * @return string The converted customized string value.
	 */
	public function convertTo( $value )
	{
		if ( false === is_bool( $value ) )
		{
			throw $this->getInvalidTypeException( $value, ValidTypes::BOOL );
		}

		return false === $value
			? $this->customizedStrings[ 0 ]
			: $this->customizedStrings[ 1 ];
	}

	/**
	 * Converts from a string into a bool value.
	 * @param string $value The customized string value which has to be converted.
	 * @return bool The converted bool value.
	 */
	public function convertFrom( $value )
	{
		if ( false === is_string( $value ) )
		{
			throw $this->getInvalidTypeException( $value, ValidTypes::STRING );
		}

		$validValues = implode( '|', $this->customizedStrings );

		if ( false === in_array( $value, $this->customizedStrings ) )
		{
			throw $this->getInvalidValueException( $value, $validValues );
		}

		$regularExpression = new RegularExpression(
			sprintf(
				'~^%s$~',
				$validValues
			)
		);
		if ( null === $regularExpression->match( $value, false ) )
		{
			throw $this->getInvalidValueException( $value, ValidValuesRegularExpressions::REGEX_BOOL_STRING );
		}

		return $this->customizedStrings[ 0 ] === $value
			? false
			: true;
	}
}

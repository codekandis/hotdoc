<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

use function array_map;
use function implode;
use function sprintf;

/**
 * Represents the base class of any component.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractComponent implements ComponentInterface
{
	/**
	 * Stores the ID of the component.
	 * @var ?string
	 */
	protected ?string $id;

	/**
	 * Stores the classes of the component.
	 * @var ?string[]
	 */
	protected ?array $classes;

	/**
	 * Stores the data attributes of the component.
	 * @var ?string[]
	 */
	protected ?array $dataAttributes;

	/**
	 * Stores the style of the component.
	 * @var string
	 */
	protected string $style;

	/**
	 * Stores the label of the component.
	 * @var ?string
	 */
	protected ?string $label;

	/**
	 * Constructor method.
	 * @param ?string $id The unique ID of the component.
	 * @param ?string[] $classes The classes of the component.
	 * @param ?string[] $dataAttributes The data attributes of the component.
	 * @param string $style The style of the component.
	 * @param ?string $label The label of the component.
	 */
	public function __construct( ?string $id, ?array $classes, ?array $dataAttributes, string $style, ?string $label )
	{
		$this->id             = $id;
		$this->classes        = $classes;
		$this->dataAttributes = $dataAttributes;
		$this->style          = $style;
		$this->label          = $label;
	}

	/**
	 * Renders the ID string of the component.
	 * @return ?string The ID string of the component, if set, otherwise null.
	 */
	protected function renderId(): ?string
	{
		return null === $this->id || '' === $this->id
			? null
			: sprintf(
				' id="%s"',
				$this->id
			);
	}

	/**
	 * Renders the class attribute string of the component.
	 * @return ?string The class attribute string of the component, if set, otherwise null.
	 */
	protected function renderClasses(): ?string
	{
		return null === $this->classes || 0 === count( $this->classes )
			? null
			: sprintf(
				' class="%s"',
				implode(
					' ',
					$this->classes
				)
			);
	}

	/**
	 * Renders the data attributes string of the component.
	 * @return ?string The data attributes string of the component, if set, otherwise null.
	 */
	protected function renderDataAttributes(): ?string
	{
		return null === $this->dataAttributes || 0 === count( $this->dataAttributes )
			? null
			: implode(
				'',
				array_map(
					function ( string $dataAttributeKey, string $dataAttributeValue ): string
					{
						return sprintf(
							' data-%s="%s"',
							$dataAttributeKey,
							$dataAttributeValue
						);
					},
					array_keys( $this->dataAttributes ),
					$this->dataAttributes
				)
			);
	}
}

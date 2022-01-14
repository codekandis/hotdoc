<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

/**
 * Represents the base class of any form control component.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractFormControlComponent extends AbstractComponent
{
	/**
	 * Stores the HTML tag of the component.
	 * @var string
	 */
	protected string $htmlTag;

	/**
	 * Stores the unique ID of the label.
	 * @var ?string
	 */
	protected ?string $labelId;

	/**
	 * {@inheritDoc}
	 * @param string $labelId The unique ID of the label.
	 */
	public function __construct( string $htmlTag, ?string $id, ?array $classes, ?array $dataAttributes, string $style, ?string $label, ?string $labelId )
	{
		parent::__construct( $id, $classes, $dataAttributes, $style, $label );

		$this->htmlTag = $htmlTag;
		$this->labelId = $labelId;
	}
}

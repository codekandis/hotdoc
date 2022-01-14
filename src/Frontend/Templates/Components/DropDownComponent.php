<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

use function implode;
use function sprintf;

/**
 * Represents a dropdown component.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class DropDownComponent extends AbstractFormControlComponent
{
	/**
	 * Stores the items of the dropdown.
	 * @var array
	 */
	private array $items;

	/**
	 * Stores the pre-selected item.
	 * @var ?string
	 */
	private ?string $preSelectedItem;

	/**
	 * {@inheritDoc}
	 * @param string $htmlTag The HTML tag of the component.
	 * @param string[] $items The items of the dropdown.
	 * @param string $preSelectedItem The pre-selected item.
	 */
	public function __construct( string $htmlTag, ?string $id, array $classes, array $dataAttributes, string $style, ?string $labelId, ?string $label, array $items, ?string $preSelectedItem )
	{
		parent::__construct( $htmlTag, $id, $classes, $dataAttributes, $style, $label, $labelId );

		$this->items           = $items;
		$this->preSelectedItem = $preSelectedItem;
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		return sprintf(
			<<<END
				<%1\$s%2\$s%3\$s%4\$s data-component-type="%5\$s" data-component-style="%6\$s">
					<input id="%7\$s" type="checkbox"/>
					<label for="%7\$s">%8\$s</label>
					%9\$s
				</%1\$s>
			END,
			$this->htmlTag,
			$this->renderId(),
			$this->renderClasses(),
			$this->renderDataAttributes(),
			ComponentTypes::DROPDOWN,
			$this->style,
			$this->labelId,
			$this->preSelectedItem ?? $this->label,
			0 === count( $this->items )
				? null
				: sprintf(
				'<ul>%s</ul>',
				implode( '', $this->items )
			)
		);
	}
}

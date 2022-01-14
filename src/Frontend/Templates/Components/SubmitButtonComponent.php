<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

use function sprintf;

/**
 * Represents a submit button form control.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class SubmitButtonComponent extends AbstractFormControlComponent
{
	/**
	 * Stores the value of the submit button.
	 * @var ?string
	 */
	private ?string $value;

	/**
	 * {@inheritDoc}
	 * @param ?string $value The value of the submit button.
	 */
	public function __construct( string $htmlTag, ?string $id, ?array $classes, ?array $dataAttributes, string $style, ?string $label, ?string $labelId, ?string $value )
	{
		parent::__construct( $htmlTag, $id, $classes, $dataAttributes, $style, $label, $labelId );

		$this->value = $value;
	}

	/**
	 * Renders the value of the submit button.
	 * @return ?string The value of the submit button, if set, otherwise null.
	 */
	private function renderValue(): ?string
	{
		return null === $this->value || '' === $this->value
			? null
			: sprintf(
				' value="%s"',
				$this->value
			);
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		return sprintf(
			<<<END
				<%1\$s data-component-type="%2\$s" data-component-style="%3\$s">
					<input%4\$s%5\$s%6\$s%7\$s type="submit"/>
				</%1\$s>
			END,
			$this->htmlTag,
			ComponentTypes::SUBMIT_BUTTON,
			$this->style,
			$this->renderId(),
			$this->renderClasses(),
			$this->renderDataAttributes(),
			$this->renderValue()
		);
	}
}

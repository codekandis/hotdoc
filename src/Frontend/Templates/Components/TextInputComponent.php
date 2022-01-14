<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

use function sprintf;

/**
 * Represents a text input form control.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class TextInputComponent extends AbstractFormControlComponent
{
	/**
	 * Stores the name of the text input.
	 * @var ?string
	 */
	private ?string $name;

	/**
	 * Stores the placeholder of the text input.
	 * @var ?string
	 */
	private ?string $placeholder;

	/**
	 * Stores the value of the text input.
	 * @var ?string
	 */
	private ?string $value;

	/**
	 * {@inheritDoc}
	 * @param ?string $name The name of the text input.
	 * @param ?string $placeholder The placeholder of the text input.
	 * @param ?string $value The value of the text input.
	 */
	public function __construct( string $htmlTag, ?string $id, ?array $classes, ?array $dataAttributes, string $style, ?string $label, ?string $labelId, ?string $name, ?string $placeholder, ?string $value )
	{
		parent::__construct( $htmlTag, $id, $classes, $dataAttributes, $style, $label, $labelId );

		$this->name        = $name;
		$this->placeholder = $placeholder;
		$this->value       = $value;
	}

	/**
	 * Renders the name of the text input.
	 * @return ?string The name of the text input, if set, otherwise null.
	 */
	private function renderName(): ?string
	{
		return null === $this->name || '' === $this->name
			? null
			: sprintf(
				' name="%s"',
				$this->name
			);
	}

	/**
	 * Renders the placeholder of the text input.
	 * @return ?string The placeholder of the text input, if set, otherwise null.
	 */
	private function renderPlaceholder(): ?string
	{
		return null === $this->placeholder || '' === $this->placeholder
			? null
			: sprintf(
				' placeholder="%s"',
				$this->placeholder
			);
	}

	/**
	 * Renders the value of the text input.
	 * @return ?string The value of the text input, if set, otherwise null.
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
					<input%4\$s%5\$s%6\$s%7\$s%8\$s%9\$s type="text"/>
				</%1\$s>
			END,
			$this->htmlTag,
			ComponentTypes::TEXT_INPUT,
			$this->style,
			$this->renderId(),
			$this->renderClasses(),
			$this->renderDataAttributes(),
			$this->renderName(),
			$this->renderPlaceholder(),
			$this->renderValue()
		);
	}
}

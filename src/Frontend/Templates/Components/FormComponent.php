<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Components;

use function sprintf;

/**
 * Represents a form component.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class FormComponent extends AbstractComponent
{
	/**
	 * Stores the tag of the label.
	 * @var string
	 */
	private string $labelTag;

	/**
	 * Stores the form action.
	 * @var string
	 */
	private string $action;

	/**
	 * Stores the form method.
	 * @var string
	 */
	private string $method;

	/**
	 * Stores the form components.
	 * @var ComponentInterface[]
	 */
	private array $components;

	/**
	 * {@inheritDoc}
	 * @param ComponentInterface[] $components The components of the form.
	 */
	public function __construct( string $id, array $classes, array $dataAttributes, string $style, ?string $label, string $labelTag, string $action, string $method, array $components )
	{
		parent::__construct( $id, $classes, $dataAttributes, $style, $label );

		$this->labelTag   = $labelTag;
		$this->action     = $action;
		$this->method     = $method;
		$this->components = $components;
	}

	/**
	 * Renders the form components.
	 * @return string The rendered components.
	 */
	private function renderComponents(): string
	{
		return implode(
			'',
			array_map(
				function ( ComponentInterface $component ): string
				{
					return $component->render();
				},
				$this->components
			)
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function render(): string
	{
		return sprintf(
			<<<END
				<form%1\$s%2\$s%3\$s data-component-type="%4\$s" data-component-style="%5\$s" action="%6\$s" method="%7\$s" enctype="application/x-www-form-urlencoded">
					<div data-component-subtype="%8\$s">
						<%9\$s>%10\$s</%9\$s>
					</div>
					<div data-component-subtype="%11\$s">
						%12\$s
					</div>
				</form>
			END,
			$this->renderId(),
			$this->renderClasses(),
			$this->renderDataAttributes(),
			ComponentTypes::FORM,
			$this->style,
			$this->action,
			$this->method,
			ComponentSubTypes::HEADER,
			$this->labelTag,
			$this->label,
			ComponentSubTypes::BODY,
			$this->renderComponents()
		);
	}
}

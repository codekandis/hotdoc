<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\HotDoc\Frontend\Templates\Components\ComponentStyles;
use CodeKandis\HotDoc\Frontend\Templates\Components\DropDownComponent;
use function sprintf;

/**
 * Represents a header generator for signed-out users.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class SignedOutHeaderContentGenerator implements HtmlGeneratorInterface
{
	/**
	 * {@inheritDoc}
	 */
	public function generate(): string
	{
		return sprintf(
			'<ul>%s</ul>',
			implode(
				'',
				[
					'<li class="logo"><a href="/"><img src="/assets/images/logo.svg"/> <span>HotDoc</span></a></li>',
					( new DropDownComponent(
						'li',
						'userActionsId',
						[
							'avatar'
						],
						[
							'purpose' => ElementPurposes::USER_ACTIONS
						],
						ComponentStyles::NONE,
						'userActions',
						'<img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp"/>',
						[],
						null,
					) )
						->render()
				]
			)
		);
	}
}

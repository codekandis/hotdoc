<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Templates\Generators;

use CodeKandis\HotDoc\Environment\Entities\UserEntityInterface;
use CodeKandis\HotDoc\Frontend\Http\UriBuilders\FrontendUriBuilderInterface;
use CodeKandis\HotDoc\Frontend\Templates\Components\ComponentStyles;
use CodeKandis\HotDoc\Frontend\Templates\Components\DropDownComponent;
use function sprintf;
use function str_pad;

/**
 * Represents a header generator for signed-in users.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class SignedInHeaderContentGenerator implements HtmlGeneratorInterface
{
	/**
	 * Stores the signed-in user.
	 * @var UserEntityInterface
	 */
	private UserEntityInterface $signedInUser;

	/**
	 * Stores the frontend URI builder of the application.
	 * @var FrontendUriBuilderInterface
	 */
	private FrontendUriBuilderInterface $frontendUriBuilder;

	/**
	 * Constructor method.
	 * @param UserEntityInterface $signedInUser The signed-in user.
	 * @param FrontendUriBuilderInterface $frontendUriBuilder The frontend URI builder of the application.
	 */
	public function __construct( UserEntityInterface $signedInUser, FrontendUriBuilderInterface $frontendUriBuilder )
	{
		$this->signedInUser       = $signedInUser;
		$this->frontendUriBuilder = $frontendUriBuilder;
	}

	/**
	 * {@inheritDoc}
	 */
	public function generate(): string
	{
		$gravatarHash = '' === $this->signedInUser->getEMail()
			? str_pad( '', 32, '0' )
			: md5( $this->signedInUser->getEMail() );

		return sprintf(
			'<ul>%s</ul>',
			( new DropDownComponent(
				'li',
				'userActionsId',
				[
					'avatar'
				],
				[
					'purpose' => ElementPurposes::USER_ACTIONS
				],
				'userActions',
				sprintf(
					'<img src="https://www.gravatar.com/avatar/%s?d=mp"/>',
					$gravatarHash
				),
				ComponentStyles::NONE,
				[
					sprintf(
						'<li><a href="%s"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li>',
						$this->frontendUriBuilder->buildSignoutUri()
					)
				],
				null,
			) )
				->render()
		);
	}
}

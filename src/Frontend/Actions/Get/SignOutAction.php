<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Frontend\Actions\Get;

use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistry;
use CodeKandis\HotDoc\Frontend\Actions\AbstractAction;
use CodeKandis\HotDoc\Frontend\Http\UriBuilders\FrontendUriBuilder;
use CodeKandis\Session\SessionHandler;
use CodeKandis\Tiphy\Http\Responses\RedirectResponder;
use CodeKandis\Tiphy\Http\Responses\StatusCodes;

/**
 * Represents an action to sign out a user.
 * @package codekandis/hotdoc
 * @author Christian Ramelow <info@codekandis.net>
 */
class SignOutAction extends AbstractAction
{
	/**
	 * {@inheritDoc}
	 */
	public function execute(): void
	{
		$sessionHandler = new SessionHandler(
			$this
				->getFrontendConfigurationRegistry()
				->getSessionsConfiguration()
		);
		$sessionHandler->start();
		$sessionHandler->destroy();

		( new RedirectResponder(
			( new FrontendUriBuilder(
				FrontendConfigurationRegistry
					::_()
					->getUriBuilderConfiguration()
			) )
				->buildIndexUri(),
			StatusCodes::FOUND
		) )
			->respond();
	}
}

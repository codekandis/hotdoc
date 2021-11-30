<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc;

use CodeKandis\HotDoc\Configurations\FrontendConfigurationRegistry;
use CodeKandis\SentryClient\SentryClient;
use CodeKandis\Tiphy\Actions\ActionDispatcher;
use CodeKandis\TiphySentryClientIntegration\Throwables\Handlers\InternalServerErrorThrowableHandler;
use function dirname;
use function error_reporting;
use function ini_set;
use const E_ALL;

/**
 * Represents the bootstrap script of the project.
 * @package codekandis/hotdoc
 * @author  Christian Ramelow <info@codekandis.net>
 */
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'html_errors', 'Off' );

require_once dirname( __DIR__, 1 ) . '/vendor/autoload.php';

/** @var FrontendConfigurationRegistry $configurationRegistry */
$configurationRegistry = FrontendConfigurationRegistry::_();
$sentryClient          = new SentryClient( $configurationRegistry->getSentryClientConfiguration() );
$sentryClient->register();

$actionDispatcher = new ActionDispatcher(
	$configurationRegistry->getRoutesConfiguration(),
	null,
	new InternalServerErrorThrowableHandler( $sentryClient )
);
$actionDispatcher->dispatch();

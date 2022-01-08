<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations\Plain;

use CodeKandis\Session\SessionOptions;

return [
	'options'  => [
		SessionOptions::USE_STRICT_MODE => 'On',
		SessionOptions::COOKIE_SECURE   => 'On',
		SessionOptions::GC_MAXLIFETIME  => 43200,
		SessionOptions::COOKIE_LIFETIME => 43200
	],
	'savePath' => null
];

<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations\Plain;

use CodeKandis\Persistence\PersistenceDrivers;

return [
	'driver'       => PersistenceDrivers::MYSQL,
	'host'         => 'localhost',
	'databaseName' => 'hotdoc.codekandis',
	'username'     => 'root',
	'passphrase'   => 'root',
];

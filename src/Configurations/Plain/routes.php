<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations\Plain;

use CodeKandis\HotDoc\Frontend\Actions as Frontend;
use CodeKandis\Tiphy\Http\Requests\Methods;

return [
	'baseRoute' => '',
	'routes'    => [
		'^/$'                          => [
			Methods::GET => Frontend\Get\ShowChapterAction::class
		],
		'^/books/(?<book>.+?)(:?/(?<chapter>.+))$' => [
			Methods::GET => Frontend\Get\ShowChapterAction::class
		]
	]
];

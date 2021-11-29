<?php declare( strict_types = 1 );
namespace CodeKandis\HotDoc\Configurations\Plain;

use CodeKandis\HotDoc\Frontend\Actions as Frontend;
use CodeKandis\Tiphy\Http\Requests\Methods;

return [
	'baseRoute' => '',
	'routes'    => [
		'^/$'                                                              => [],
		'^/books/(?<canonicalBookName>[^/]+)/(?<canonicalChapterName>.+)$' => [
			Methods::GET => Frontend\Get\ShowChapterAction::class
		]
	]
];

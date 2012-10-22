<?php
	namespace Kernel\Routing\URLMatcher;
	
	use Kernel\URIRequest\URIRequest;
	use Kernel\Routing\RouteCache\RouteCache;

	interface URLMatcherInterface
	{
		public function match ( URIRequest $uri, RouteCache $routes );
	}
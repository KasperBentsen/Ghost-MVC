<?php
	namespace Kernel\Routing;

	use Kernel\URIRequest\URIRequest;
	use Kernel\Loading\Loader;
	
	/**
	 * RouterInterface
	 *
	 * All routers must implement this interface.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	interface RouterInterface
	{
		public function __construct ( Loader $loader, URIRequest $uri );
	}
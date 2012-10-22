<?php
	namespace Kernel\Routing;

	use Kernel\URIRequest\URIRequest;
	use Kernel\Loading\Loader;
	use Kernel\Routing\URLMatcher\URLMatcher;
	use Kernel\Routing\RouteCache\RouteCache;
	

	/**
	 * Router
	 *
	 * Routes to a Controller based on the URI.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	class Router implements RouterInterface
	{
		protected $load;
		protected $UrlMatcher;
		protected $RouteCache;
		
		/**
		 * Construct
		 *
		 * @var URIInterface $uri
		 */
		
		public function __construct ( Loader $loader, URIRequest $uri )
		{
			$this->load = $loader;
			
			$this->load->kernelObject ( 'URLMatcher' );
			$this->load->kernelObject ( 'RouteCache' );
			
			$this->RouteCache = new RouteCache();
			
			$this->UrlMatcher = new URLMatcher();
			$this->UrlMatcher->match ( $uri, $this->RouteCache );
		}
	}
	
<?php
	namespace Kernel\Routing\RouteCache;

	use Components\Filesystem;
	
	/**
	 * Route Cache
	 *
	 * Loops through all route files and caches them.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	class RouteCache implements RouteCacheInterface
	{
		public $routes;
		
		/**
		 * Constructor
		 *
		 * Loads all routing files from applications and caches them.
		 */
		
		public function __construct ()
		{
			$routes = $this->find_routes ();			
			$routes = $this->buildRoutes ( $routes );
			
			$this->routes = $routes;
		}
		
		/**
		 * Build Routes
		 *
		 * Loads files and builds an array of all routes.
		 *
		 * @var Array $routes
		 */
		
		private function buildRoutes ( array $routes )
		{
			foreach ( $routes as $route )
			{
				require_once ( $route );
				$routesArray[] = $routes;
			}
			
			return $routes;
		}
		
		/**
		 * Find Routes
		 *
		 * Loops through the file system, and returns the paths to the routing files.
		 *
		 * @return Array $paths
		 */
		
		private function find_routes ()
		{
			$directory = 'System/Applications';
			$fs = new Filesystem ();
			
			foreach ( new \FilesystemIterator ( $directory ) as $file )
			{
				if ( is_dir ( $file ))
				{
					if ( file_exists ( $file . '/routing.php' ))
					{
						$paths[] = $file . '/routing.php';
						continue;
					}
				}
			}
			
			return $paths;
		}
		
		/**
		 * {@inheritdoc}
		 */
		
		public function store ( array $item )
		{
			
		}
		
		/**
		 * {@inheritdoc}
		 */	
		
		public function get ( $item )
		{
			
		}
	}
<?php
	namespace Kernel\Routing\URLMatcher;
	
	use Components\Filesystem;
	use Kernel\URIRequest\URIRequest;
	use Kernel\Routing\RouteCache\RouteCache;
		
	/**
	 * URLMatcher
	 *
	 * Matches the url to Controllers
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	class URLMatcher implements URLMatcherInterface
	{
		/**
		 * Match
		 *
		 * Takes an array of URL parameters on matches it to a Controller.
		 *
		 * @var Array $uri
		 */
		
		public function match ( URIRequest $uri, RouteCache $routeCache )
		{
			$url = $uri->uri;
			$length = count ( $url );
			
			foreach ( $routeCache->routes as $index => $route )
			{
				if ( ! is_array ( $route ))
				{
					$controller = $route;
				}
				
				if ( is_array( $route ))
				{
					foreach ( $route as $pattern => $method )
					{
						$pattern = explode ( '/', $pattern );
						
						if ( $pattern[0] != $url[0] || count ( $pattern ) != $length )
						{
							continue;
						}

						$vars = array ();
						$vars['method'] = $method;
						
						$_pattern = $pattern;
						unset ( $_pattern[0] );
						
						foreach ( $_pattern as $key => $element )
						{
							if ( preg_match ( '#\{.+\}#', $element ))
							{
								$element = preg_replace('/[^a-zA-Z0-9\s]/', '', $element);
								$vars[$element] = $url[$key];
							}
							else
							{
								if ( $element != $url[$key] )
								{
									unset ( $vars );
									continue;
								}
							}
						}
						
					}
					
					if ( ! isset ( $vars ))
					{
						echo '404!';
						exit;
					}
					
					$method = $vars['method'];
					unset ( $vars['method'] );
					
					$controller = ucfirst ( $controller );
					require_once ( 'System/Applications/' . $controller . '/' . $controller . '.php' );
					
					$controller = new $controller ();
					$controller->$method( $vars );
				}
			}
		}
	}
<?php	
	use Kernel\Routing\Router;
	use Kernel\Loading\Loader;
	use Kernel\URIRequest\URIRequest;
	
	/**
	 * Ghost
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 * @date   September 3, 2012
	 */
	 
	require_once ( 'System/Components/Filesystem/Filesystem.php' );
	
	require_once ( 'System/Kernel/Cache/CacheInterface.php' );	
	require_once ( 'System/Kernel/Router/URLMatcher/URLMatcherInterface.php' );
	
	require_once ( 'System/Kernel/Router/RouteCache/RouteCacheInterface.php' );
	require_once ( 'System/Kernel/Router/RouteCache/RouteCache.php' );
	
	require_once ( 'System/Kernel/Router/RouterInterface.php' );
	
	require_once ( 'System/Kernel/URIRequest/URIInterface.php' );
	require_once ( 'System/Kernel/URIRequest/URIRequest.php' );
	
	require_once ( 'System/Kernel/Loader/LoaderInterface.php' );
	require_once ( 'System/Kernel/Loader/Loader.php' );
	
	require_once ( 'System/Kernel/Router/Router.php' );
	
	
	$loader = new Loader ();	
	$Router = new Router ( $loader, new URIRequest ( $_SERVER['REQUEST_URI'] ));
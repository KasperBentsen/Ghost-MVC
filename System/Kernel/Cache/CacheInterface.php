<?php
	namespace Kernel\Caching;

	/**
	 * Cache Interface
	 *
	 * All caches must implement the Cache interface.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	interface CacheInterface
	{
		public function store ( array $item );
		public function get ( $item );
	}
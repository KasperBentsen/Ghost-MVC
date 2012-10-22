<?php
	namespace Kernel\Loading;

	/**
	 * URIInterface
	 *
	 * All URIRequest Objects must implement the URIInterface
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	interface LoaderInterface
	{
		public function kernelObject ( $object_name );
	}
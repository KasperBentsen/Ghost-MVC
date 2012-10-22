<?php
	namespace Kernel\URIRequest;

	/**
	 * URIInterface
	 *
	 * All URIRequest Objects must implement the URIInterface
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	interface URIInterface
	{
		public function __construct ( $uri );
	}
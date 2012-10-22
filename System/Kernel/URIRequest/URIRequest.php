<?php
	namespace Kernel\URIRequest;
	
	/**
	 * URIRequest
	 *
	 * Handles the URI.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	class URIRequest implements URIInterface
	{
		public $uri;
		
		/**
		 * Contructor
		 *
		 * Starts the URL matching process.
		 *
		 * @var String $uri
		 */
		
		public function __construct ( $uri )
		{
			$uri = explode ( '/', $uri );
			
			foreach ( $uri as $key => $uriElement )
			{
				if ( $uriElement == '' )
				{
					$uri[$key] = '';
				}
			}
			
			$uri = array_merge ( array(), $uri );
			
			$this->uri = $uri;
		}
	}
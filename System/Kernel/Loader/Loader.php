<?php
	namespace Kernel\Loading;
	
	use Components\Filesystem;

	/**
	 * Loader
	 *
	 * Loads files.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	
	class Loader implements LoaderInterface
	{
		private $filesystem;
		
		/**
		 * Construct
		 */
		
		public function __construct ()
		{
			$this->filesystem = new Filesystem ();
		}
		
		public function kernelObject ( $object_name )
		{
			if ( $path = $this->filesystem->find ( $object_name . '.php', 'System/Kernel' ))
			{
				require_once ( $path );
			}
			else
			{
				// Throw new Loader Exception!
			}
		}
	}
	
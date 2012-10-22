<?php

	namespace Components;
	
	use Components\Filesystem\IOException;
	
	/**
	 * Filesystem
	 *
	 * Provides a toolset to manipulate the filesystem.
	 * Uses IOException for error handling.
	 *
	 * @author Kasper Bentsen <kasper@nabo.dk>
	 */
	 
	 class Filesystem
	 {
		/**
		 * Copy
		 *
		 * This method copies a file, and if a target file already exists, replaces that file,
		 * if the target is not newer than the origin file.
		 *
		 * By default overrides targeted file if origin is newer.
		 *
		 * @param String  $origin Path to the file which should be copied.
		 * @param String  $target Path to where the origin file should be copied to.
		 * @param Boolean $override Wether or not to override target file, if one exists.
		 */
		 
		public function cp ( $origin, $target, $override = true )
		{
			if ( $this->exists ( $target ) && $override === false )
			{
				throw new IOException ( sprintf ( "Couldn't copy file %s cause the targeted file %s already exists.", $origin, $target ));
			}
			else if ( ! $this->exists ( $origin ))
			{
				throw new IOException ( sprintf ( "Origin file, %s, doesn't exist.", $origin ));
			}
			
			$this->mkdir ( dirname ( $target ));
			
			if ( ! copy ( $origin, $target ))
			{
				throw new IOException ( sprintf ( "Couldn't copy file %s", $origin ));
			}
		}
		
		/**
		 * Find
		 *
		 * Loops through directory, trying to find $filename.
		 *
		 * @param String  $filename     Path to the file to find
		 * @param String  $directory    Path to where the file should be found.
		 */
		
		public function find ( $filename, $directory )
		{
			foreach ( $this->iterator ( $directory ) as $file )
			{
				if ( is_dir ( $file ))
				{
					$subFile = $this->find ( $filename, new \FilesystemIterator ( $file ));
				
					if ( substr ( $subFile, ( strrpos ( $subFile, '/' ) + 1 ), strlen ( $subFile )) == $filename )
					{
						return $subFile;
					}
				}
				
				if ( substr ( $file, ( strrpos ( $file, '/' ) + 1 ), strlen ( $file )) == $filename )
				{
					return $file;
				}
			}
		}
		
		/**
		 * Exists
		 *
		 * Checks wether or not a given file exists.
		 *
		 * @param String|Array|Iterator $files Path to file(s).
		 * @param Boolean				$fail_gracefully if true, returns a list of files that doesn't exist, else returns false at first encounter.
		 *
		 * @return If fail_gracefully is false: Boolean true if the file exists, otherwise, false.
		 * @return If fail_gracefully is true:  Array of files that doens't exist.
		 */
		
		public function exists ( $files, $fail_gracefully = false )
		{
			$non_existing_files = array ();
			
			foreach ( $this->iterator ( $files ) as $file)
			{
				if ( ! file_exists ( $file ))
				{
					if ( $fail_gracefully === true )
					{
						$non_existing_files[] = $file;
					}
					else
					{
						return false;
					}
				}
			}
			
			if ( $fail_gracefully )
			{
				return $non_existing_files;
			}
			
			return true;
		}
		
		/**
		 * mkdir
		 *
		 * Creates a directory if one doesn't exist.
		 *
		 * @param String|Array|Iterator $directories Path to directory.
		 * @param Integer               $chmod   	 Specifies permissions. 
		 */
		
		public function mkdir ( $directories, $chmod = 0777 )
		{
			foreach ( $this->iterator ( $directories ) as $directory )
			{
				if ( is_dir ( $directory ))
				{
					continue;
				}
				
				if ( ! mkdir ( $directory, $chmod, true ))
				{
					throw new IOException ( sprintf ( 'Could not create directory, %s' , $directory ));
				}
			}
		}
		
		/**
		 * Chmod
		 *
		 * Changes file permissions of an array of files or a file.
		 *
		 * @param String|Array|Iterator $files 		Path to files.
		 * @param Integer				$chmod 		Permission mode.
		 * @param Boolean				$recursive	Wether or not to recursively change a folder and all sub folders.
		 *
		 */
		
		public function chmod ( $files, $chmod, $recursive = false )
		{
			foreach ( $this->iterator ( $files ) as $file )
			{
				if ( $recursive && is_dir ( $file ))
				{
					$this->chmod ( new \FilesystemIterator ( $file ), $chmod, true );
				}
				
				if ( ! chmod ( $file, $chmod ))
				{
					throw new IOException ( sprintf ( "Couldn't set chmod for file, %s", $file ));
				}
			}
		}
		
		/**
		 * Iterator
		 *
		 * @param Mixed $files
		 *
		 * @return \Traversable
		 */
		
		private function iterator ( $files )
		{
			if ( ! $files instanceof \Traversable )
			{
				$files = array ( $files );
			}
			
			return $files;
		}
	 }
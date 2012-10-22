<?php
class News
{
	public function __construct ( )
	{
		echo "Started!";
	}
	
	public function delete ( $args )
	{
		print_r( $args );
	}
}

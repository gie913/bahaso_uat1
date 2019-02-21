<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rupiah'))
{
	function rupiah($nilai)
	{
		
	$a= number_format($nilai,0,',','.');	
	return $a;	
		
	}	
		
		
}
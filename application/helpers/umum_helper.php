<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('string4url')){
function string4url($text)
	{
		$exp		= explode('/',$text);
		$exp1		= rtrim($exp[0]);
		$string		= strtolower(str_replace(' ','_',$exp1));
		return	$string;	
	}
}	
	
	
	


if ( ! function_exists('pecahkata')){
function pecahkata($text)
	{
		$text2=strip_tags($text);
		$line=strip_tags($text);
		if (preg_match('/^.{1,100}\b/s', $text2, $match))
		{
		return $line=$match[0];
		}
	}
}	


if ( ! function_exists('generateRandomString')){
	function generateRandomString($length) {
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
}

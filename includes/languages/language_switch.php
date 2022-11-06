<?php


//// Languages URLs ////
$english_link = dirname($_SERVER['PHP_SELF']) . "?1=1&" . $_SERVER['QUERY_STRING'].'&language=EN';
$arabic_link = dirname($_SERVER['PHP_SELF']) ."?1=1&" . $_SERVER['QUERY_STRING'].'&language=AR';

$current_link=dirname($_SERVER['PHP_SELF']) .'/'. "?1=1&" . $_SERVER['QUERY_STRING'];
////


if(!isset($_SESSION['language'])) {
	$_SESSION['language']='EN';
}else {

	if(isset($_GET['language']) && $_GET['language']=='EN') {
		$_SESSION['language']='EN';
	}

	if(isset($_GET['language']) && $_GET['language']=='AR') {
		$_SESSION['language']='AR';
	}

}
?>
<?php
require_once 'functions.php';
if (isset($_GET['page']) && $_GET['page'] !== "/") {
	$page = strtolower($_GET['page']);
	if ($page == "login") {
		if (isset($_SESSION['user_id'])) {
			header("Location: /account");
			exit();
		}
		require_once( 'header.php');
		require_once ('login.php');
		require_once( 'footer.php');
	}elseif ($page == "register" ) {
		if (isset($_SESSION['user_id'])) {
			header("Location: /account");
			exit();
		}
		require_once( 'header.php');
		require_once ('register.php');
		require_once( 'footer.php');
	}elseif ($page == "account" ) {
		if (!isset($_SESSION['user_id'])) {
			header("Location: /login");
			exit();
		}
		require_once( 'header.php');
		require_once ('account.php');
		require_once( 'footer.php');
	}elseif ($page == "product" ) {
		require_once( 'header.php');
		require_once ('product.php');
		require_once( 'footer.php');
	}elseif ($page == "search" ) {
		require_once( 'header.php');
		require_once ('product-search.php');
		require_once( 'footer.php');
	}elseif ($page == "review" ) {
		require_once ('review.php');
	}elseif ($page == "payment" ) {
		require_once ('make-payment.php');
	}elseif ($page == "pay-now" ) {
		require_once ('pay-now.php');
	}elseif ($page == "categories" ) {
		require_once( 'header.php');
		require_once ('categories-page.php');
		require_once( 'footer.php');
	}elseif ($page == "about" ) {
		require_once( 'header.php');
		require_once ('about-us-page.php');
		require_once( 'footer.php');
	}else{
		$_POST['code'] = 404;
		require_once( 'header.php');
		require_once "error.php";
		require_once( 'footer.php');
	}
}else{
	require_once( 'header.php');
	require_once( 'home.php');
	require_once( 'footer.php');
}
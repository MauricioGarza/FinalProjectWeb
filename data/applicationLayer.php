<?php

	header('Content-type: application/json');
	header('Accept: application/json');

	require_once __DIR__ . '/dataLayer.php';

	$requestMethod = $_SERVER['REQUEST_METHOD'];

	switch ($requestMethod)
	{
		case "GET" : $action = $_GET["action"];
					 getRequests($action);
					 break;
		case "POST" : $action = $_POST["action"];
					getPosts($action);
					break;
	}

	function getRequests($action)
	{
		switch($action)
		{
			case "LOGIN": requestLogin();
						  break;
			case "FILTER": requestProducts();
							break;
			case "GETCART":getCart();
							break;
		}
	}

	function getPosts($action){
		switch($action){
			case "ADD_CART" : addToCart();
				break;
		}
	}

	function getCart(){
		$username = 1;
		$response = getShoppingCart($username);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	
	function addToCart(){
		$username = 1;
		$product_id = $_POST["product"];
		$response = addCart($product_id, $username);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["status"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function removeFromCart(){
		$username = 1;
		$product_id = $_GET["product"];
		$response = cancelCart($product_id, $username);
	}

	function requestLogin()
	{
		$uName = $_GET["username"];
		$uPassword = $_GET["password"];

		$response = attemptLogin($uName, $uPassword);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function requestProducts()
	{

		$typefilter = $_GET["filterType"];
		if ($typefilter == "null") {
			$typefilter = 0;
		}
		$response = getProducts($typefilter);

		if ($response["status"] == "SUCCESS")
		{
			echo json_encode($response["response"]);
		}
		else
		{
			errorHandler($response["status"], $response["code"]);
		}
	}

	function errorHandler($status, $code)
	{
		switch ($code)
		{
			case 406:	header("HTTP/1.1 $code User $status");
						die("Wrong credentials provided");
						break;
			case 500:	header("HTTP/1.1 $code $status. Bad connection, portal is down");
						die("The server is down, we couldn't retrieve data from the data base");
						break;
		}
	}


?>

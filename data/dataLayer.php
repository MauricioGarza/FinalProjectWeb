<?php

	function connect()
	{
		$servername = "localhost";
		$username = "root";
		$password= "root";
		$dbname = "Parleria";

		$connection = new mysqli($servername, $username, $password, $dbname);

		if ($connection->connect_error)
		{
			return null;
		}
		else
		{
			return $connection;
		}
	}

	function attemptLogin($username, $password)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT *
					FROM Users
					WHERE username = '$username' AND passwrd = '$password'";

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$response = array("firstName" => $row["fName"], "lastname" => $row["lName"]);
				}

				$conn -> close();
				return array("status"=>"SUCCESS", "response" => $response);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>406);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);

		}
	}

	function getShoppingCart($username){
		$conn = connect();

		if ($conn != null)
		{
			$sql = "SELECT P.*
					FROM Productos P, Carritos C
					WHERE C.user_id = $username AND C.producto_id = P.id";

			$result = $conn->query($sql);

			$resp = array();
			if ($result -> num_rows > 0)
			{
				while ($row = $result->fetch_assoc())
				{
					$response = array("nombre" => $row["nombre"], "imagen" => $row["image"], "precio" => $row["precio"]);
					array_push($resp, $response);
				}

				$conn -> close();
				return array("status"=>"SUCCESS", "response" => $resp);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>406);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);

		}
	}

	function addCart($product_id, $username)
	{
		$conn = connect();

		if ($conn != null)
		{
			$sql = "INSERT INTO carritos(user_id, producto_id)
							VALUES ($username, $product_id)";

			$result = $conn->query($sql);

			if ($result == true)
			{
				$conn -> close();
				return array("status"=>"SUCCESS");
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>406);
			}
		}
		else
		{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}
	}

	function getProducts($typefilter)
	{
		$conn = connect();
		if($conn != null){

			switch ($typefilter) {
				case '1':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 1";
					break;
				case '2':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 1 AND tipo = 1";
					break;
				case '3':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 1 AND tipo = 2";
					break;
				case '4':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 1 AND tipo = 3";
						break;
				case '5':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0";
							break;
				case '6':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0 AND tipo = 1";
							break;
				case '7':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0 AND tipo = 2";
							break;
				case '8':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0 AND tipo = 3";
							break;
				case '9':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0 AND tipo = 4";
							break;
				case '10':
				$sql = "SELECT *
								FROM productos
								WHERE es_hombre = 0 AND tipo = 5";
							break;
				default:
					$sql = "SELECT *
									FROM productos";
					break;
			}


			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				$resp = array();
				while ($row = $result->fetch_assoc())
				{
					$response = array("id" => $row["id"], "imageURL"=>$row["image"],"precio" => $row["precio"], "nombreProducto" => $row["nombre"], "descripción" => $row["descripcion"]);
					array_push($resp, $response);
				}

				$conn -> close();
				return array("status"=>"SUCCESS", "response" => $resp);
			}
			else
			{
				$conn -> close();
				return array("status" => "NOT_FOUND", "code"=>406);
			}
		} else{
			return array("status" => "INTERNAL_SERVER_ERROR", "code"=>500);
		}


	}

?>

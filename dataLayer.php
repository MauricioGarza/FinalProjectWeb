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

	function getProducts($typefilter)
	{
		$conn = connect();
		if($conn = null){
			$sql = "SELECT *
							FROM productos";

			$result = $conn->query($sql);

			if ($result -> num_rows > 0)
			{
				$resp = array();
				while ($row = $result->fetch_assoc())
				{
					$response = array("nombreProducto" => $row["nombre"], "descripción" => $row["descripcion"]);
					array_push($resp, $response);
				}

				$conn -> close();
				return array("status"=>"SUCCESS", "response" => $response);
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

<?php
	

	
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){


	//datos del cupon
	$nombre = $_POST['nombre-completo'];	
	$empresa = $_POST['empresa'];
	$productos = $_POST['productos'];
	$info = $_POST['adicional'];	
	$tel = $_POST['telefono'];
	$correo = $_POST['correo'];
	
	//credenciales de la base de datos
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "cptlandingoctubre";

	//conexion con las base de datos
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	//consulta que va a ejecutarse
	$sql = "INSERT INTO landingoct (nombre, empresa, productos, info, telefono, correo) VALUES ('".$nombre."', '".$empresa."', '".$productos."', '".$info."', '".$tel."', '".$correo."')";
	
	//escribir en el registro
	$fp = fopen('bd.log', 'a+');
	fwrite($fp, "\n".$sql."\n");
	fclose($fp);
	
		
	if($conn->query($sql) === FALSE){
		echo "Error";
	}

	$conn->close();
	
}

?>
<?php
include('conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = ibase_prepare("SELECT * FROM atencion WHERE id_atencion = '$id'");
$valores1 = ibase_execute($valores);
$valores2 = ibase_fetch_row($valores1);

$datos = array(
				0 => $valores2[0], 
				1 => $valores2[1], 
				2 => $valores2[2], 
				3 => $valores2[3],
				4 => $valores2[4],
				5 => $valores2[5],
				6 => $valores2[6],
				7 => $valores2[7],
				8 => $valores2[8],
				9 => $valores2[9],
				);
echo json_encode($datos);
?>
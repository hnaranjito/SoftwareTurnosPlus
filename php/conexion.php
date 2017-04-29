<?php
$host5 = 'localhost:C:\xampp\htdocs\Desarrollo\crud\bases\consecutivos.gdb';
$username5 = 'SYSDBA';
$passw5 = 'zitiz';
$conexion = ibase_connect($host5, $username5, $passw5 ) or die ("Error en la conexion de la Base de Datos");
//$conexion = mysql_connect('127.0.0.1', 'root', 'zitiz');
//mysql_select_db('tienda', $conexion);

function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}
?>
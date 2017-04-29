<?php
include("conexion.php");

$sql_gaten=ibase_prepare("select * from carpeta_atencion WHERE ID_CATENCION > 0 order by 1");
$rs_gaten=ibase_execute($sql_gaten);

$sql_sala=ibase_prepare("select * from SALA order by 1");
$rs_sala=ibase_execute($sql_sala);

$sql_st=ibase_prepare("select * from estado");
$rs_st=ibase_execute($sql_st);

?>
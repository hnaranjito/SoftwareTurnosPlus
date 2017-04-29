<?php
include('conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$des_aten = $_POST['des_aten'];
$caten = $_POST['caten'];
$st_aten = $_POST['st_aten'];
$new_sala = $_POST['new_sala'];
$rini = $_POST['rini'];
$rfin = $_POST['rfin'];
$prefijo = $_POST['prefijo'];
$verTouch = $_POST['verTouch'];
$orden = $_POST['orden'];
$fecha = date('Y-m-d');
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		//$sql = "INSERT INTO atencion (descripcion, estado, rango_ini, rango_fin, prefijo, id_catencion, id_sala, visualizartouch, orden) VALUES('$des_aten','$st_aten','$rini','$rfin', '$prefijo', '$caten', '$new_sala', '$verTouch', '$orden')";
		//echo $sql;
		$cons1 = ibase_prepare("INSERT INTO atencion (descripcion, estado, rango_ini, rango_fin, prefijo, id_catencion, id_sala, visualizartouch, orden) VALUES('$des_aten','$st_aten','$rini','$rfin', '$prefijo', '$caten', '$new_sala', '$verTouch', '$orden')");
		$cons2 = ibase_execute($cons1);
	break;
	
	case 'Edicion':
		//$sql = "UPDATE atencion SET descripcion = '$des_aten', estado = '$st_aten', rango_ini = $rini, rango_fin = $rfin, prefijo = '$prefijo', id_catencion = $caten, id_sala = $new_sala, visualizartouch = $verTouch, orden = $orden WHERE id_atencion = $id";
		//echo $sql;
		$cons1 = ibase_prepare("UPDATE atencion SET descripcion = '$des_aten', estado = '$st_aten', rango_ini = $rini, rango_fin = $rfin, prefijo = '$prefijo', id_catencion = $caten, id_sala = $new_sala, visualizartouch = $verTouch, orden = $orden WHERE id_atencion = $id");
		$cons2 = ibase_execute($cons1);
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = ibase_prepare("SELECT a.*, c.descripcion, e.desc_estado 
							FROM atencion a
							LEFT JOIN carpeta_atencion c ON(c.id_catencion=a.id_catencion)
							INNER JOIN estado e ON(E.id_estado=A.estado)
							WHERE a.estado in(1,2)
							 ORDER BY a.id_atencion ASC");
$registro1 = ibase_execute($registro);

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Descripci&oacute;n</th>
                <th width="200">Estado</th>
                <th width="150">Rango Inicial</th>
                <th width="150">Rango final</th>
                <th width="150">Prefijo</th>
                <th width="150">Carpeta</th>
                <th width="150">Sala</th>
                <th width="150">Ver bot&oacute;n</th>
                <th width="150">Orden</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = ibase_fetch_row($registro1)){
		echo '<tr>
				<td>'.$registro2[1].'</td>
				<td>'.$registro2[11].'</td>
				<td>'.$registro2[3].'</td>
				<td>'.$registro2[4].'</td>
				<td>'.$registro2[5].'</td>
				<td>'.$registro2[10].'</td>
				<td>'.$registro2[7].'</td>
				<td>'.$registro2[8].'</td>
				<td>'.$registro2[9].'</td>
				<td><a href="javascript:editarServicio('.$registro2[0].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarServicio('.$registro2[0].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>
<?php
include('conexion.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

$delreg = ibase_prepare("UPDATE atencion SET estado=0 WHERE id_atencion = '$id'");
$delreg1 = ibase_execute($delreg);

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = ibase_prepare("SELECT a.*, c.descripcion, e.desc_estado 
	FROM atencion a 
	LEFT OUTER JOIN carpeta_atencion c ON(c.id_catencion = a.id_catencion)
	INNER JOIN estado e ON(e.id_estado = a.estado)
	WHERE a.estado=1 
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
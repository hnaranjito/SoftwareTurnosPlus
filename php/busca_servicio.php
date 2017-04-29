<?php
include('conexion.php');

$dato = $_POST['dato'];

$dato = strtoupper($dato);

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = ibase_prepare("SELECT a.*, c.descripcion, e.desc_estado FROM atencion a
							LEFT OUTER JOIN carpeta_atencion c ON(c.id_catencion=a.id_catencion)
							INNER JOIN estado e ON(E.id_estado=A.estado)
							WHERE a.estado in(1,2) AND (a.descripcion LIKE '%$dato%' OR c.descripcion LIKE '%$dato%') 
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
$registroc = ibase_prepare("SELECT count(*) FROM atencion a 
	LEFT OUTER JOIN carpeta_atencion c ON(c.id_catencion=a.id_catencion) 
	WHERE a.descripcion LIKE '%$dato%' OR c.descripcion LIKE '%dato%'");
$registroc1 = ibase_execute($registroc);
$registroc3 = ibase_fetch_row($registroc1);
$total_records = $registroc3[0];
//echo $total_records;
if(($total_records)>0){
	while($registro2 = ibase_fetch_row($registro1)){
		echo '<tr>
				<td>'.$registro2[1].'</td>
				<td>'.$registro2[2].'</td>
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
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>
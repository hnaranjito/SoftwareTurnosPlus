<?php
	include('conexion.php');
  //$_POST['partida'] = 0;
  $paginaActual = $_POST['partida'];
  $registroc = ibase_prepare("SELECT count(*) FROM atencion");
  $registroc1 = ibase_execute($registroc);
  $registroc2 = ibase_fetch_row($registroc1);
  $nroServicios = $registroc2[0];
  $nroLotes = 5;
  $nroPaginas = ceil($nroServicios/$nroLotes);
  $lista = '';
  $tabla = '';


  $start_from = ($paginaActual) * $nroLotes;
  $_POST['partida'] = $start_from;
  
  if($start_from == 0) 
  {
    $start_from = 1;
  }
    
  $reg_fin = $start_from + ($nroLotes);

    if($paginaActual > 1){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
    }
    for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
            $lista = $lista.'<li class="active"><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }else{
            $lista = $lista.'<li><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }
    }
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}
  	
    $registro = ibase_prepare("SELECT * FROM atencion ROWS $start_from TO $reg_fin");
    $registro1 = ibase_execute($registro);

  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
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
		$tabla = $tabla.'<tr>
							<td>'.$registro2[1].'</td>
              <td>'.$registro2[2].'</td>
              <td>'.$registro2[3].'</td>
              <td>'.$registro2[4].'</td>
              <td>'.$registro2[5].'</td>
              <td>'.$registro2[6].'</td>
              <td>'.$registro2[7].'</td>
              <td>'.$registro2[8].'</td>
              <td>'.$registro2[9].'</td>
							<td><a href="javascript:editarServicio('.$registro2[0].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarServicio('.$registro2[0].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';		
	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>
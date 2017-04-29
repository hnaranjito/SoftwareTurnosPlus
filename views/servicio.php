<?php
	include("../php/combo.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Servicios</title>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
    <header>Servicios</header>
    <section>
    <table border="0" align="center">
    	<tr>
        	<td width="335"><input type="text" placeholder="Busca un servicio: Nombre" id="bs-prod"/></td>
            <td width="100"><button id="nuevo-servicio" class="btn btn-primary">Nuevo</button></td>
        </tr>
    </table>
    </section>
    <div class="registros" id="agrega-registros"></div>
    <center>
        <ul class="pagination" id="pagination"></ul>
    </center>
    <!-- MODAL PARA EL REGISTRO DEL SERVICIO-->
    <div class="modal fade" id="registra-servicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registrar un servicio</b></h4>
            </div>
            <form id="formulario" class="formulario" onsubmit="return agregaRegistro();">
	            <div class="modal-body">
					<table border="0" width="100%">
	               		 <tr>
	                        <td colspan="2"><input type="text" required="required" readonly="readonly" id="id" name="id" readonly="readonly" style="visibility:hidden; height:5px;"/></td>
	                    </tr>
	                    <tr>
	                    	<td width="150">Proceso: </td>
	                        <td><input type="text" required="required" readonly="readonly" id="pro" name="pro"/></td>
	                    </tr>
	                     <tr>
	                    	<td width="150">Descripci&oacute;n servicio: </td>
	                        <td><input class="form-control" type="text" required="required" id="des_aten" name="des_aten"/></td>
	                    </tr>
	                	<tr>
	                    	<td>Carpeta: </td>
	                        <td>
	                    	    <select class="form-control" required="required" id="caten" name="caten"/>
	                                <option value="">Seleccione una opci&oacute;n</option>
	                                <?php
	                                while($row_gaten = ibase_fetch_row($rs_gaten)){
	                                ?>
	                                	<option value="<?php echo "$row_gaten[0]"; ?>"><?php echo "$row_gaten[1]";?></option>
	                                	<?php
	                                	}//fin del while
	                                	?>
	                            </select>
	                        </td>
	                    </tr>
	                    <tr>
	                    	<td>Estado: </td>
	                        <td><select class="form-control" required="required" name="st_aten" id="st_aten">
	                        		<option value="">Seleccione una opci&oacute;n</option>
	                                    <?php
	                                    	while ( $row_st = ibase_fetch_row($rs_st) ) {
	                                        	echo $row_st[2];
	                                    ?>	
	                                    <option value="<?php echo "$row_st[0]"; ?>"> 
	                                    <?php 
	                                        echo "$row_st[1]";
	                                    ?> 
	                                	</option>
	                                    <?php
	                                    }
	                                    ?>
	                            </select></td>
	                    </tr>
	                    <tr>
	                    	<td>Sala: </td>
	                        <td><select class="form-control" required="required" name="new_sala" id="new_sala">
	                        		<option value="">Seleccione una opci&oacute;n</option>
	                                    <?php
	                                    	while($row_sala = ibase_fetch_row($rs_sala)) {
	                                    ?>
	                                    <option value="<?php echo "$row_sala[0]"; ?>"> 
	                                        <?php echo "$row_sala[1]";?> 
	                                    </option>
	                                    <?php
	                                    }
	                                    ?>
	                            </select></td>
	                    </tr>
	                    <tr>
	                    	<td>Rango Inicial: </td>
	                        <td><input class="form-control" type="number" required="required" name="rini" id="rini"/></td>
	                    </tr>
	                    <tr>
	                    	<td>Rango Final: </td>
	                        <td><input class="form-control" type="number"  required="required" name="rfin" id="rfin"/></td>
	                    </tr>
	                    <tr>
	                    	<td>Prefijo: </td>
	                        <td><input class="form-control" type="text"  required="required" name="prefijo" id="prefijo" maxlenght="1" /></td>
	                    </tr>
	                    <td>Visualizar boton en pantalla touch: </td>
	                        <td><select class="form-control" required="required" name="verTouch" id="verTouch">
									<option value="">Seleccione una opci&oacute;n</option>
		                            <option value="1">Si</option>
		                            <option value="0">No</option>
		                        </select>
	                        </td>
	                    <tr>
	                	<tr>
		                	<td>Orden: </td>
		                    <td><input class="form-control" type="number"  required="required" name="orden" id="orden" /></td>
	                	</tr>
	                	<input name="band" type="hidden" value="1" />
	                    <input name="idaten" type="hidden" value="<?php echo "$idaten"; ?>" />
	                    	<td colspan="2">
	                        	<div id="mensaje"></div>
	                        </td>
	                    </tr>
	                </table>
	            </div>
            
            <div class="modal-footer">
            	<input type="submit" value="Registrar" class="btn btn-success" id="reg"/>
                <input type="submit" value="Editar" class="btn btn-warning"  id="edi"/>
            </div>
            </form>
          </div>
        </div>
      </div>
      

</body>
</html>
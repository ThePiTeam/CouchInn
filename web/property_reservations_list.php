
<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Couch Inn - Reserva tu proximo Hospedaje!</title>
	    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  	</head>
  	<body>
    	<?php
		if (isset ($_SESSION['rol'])){
			if (($_SESSION['rol'] == 1) || ($_SESSION['rol'] == 2)){
				include 'user_taskbar.php';
			}
			else{
				include 'admin_taskbar.php';
			}
		}
		else{
			header("Location: index.php");
		}
		
		// Conectando, seleccionando la base de datos
		include 'conexion.php';
		?>

		<div class="container">
	    	<h1 class="well">Administrar Reservas</h1>
				<form name="form1" method="post" action="reservation_administration_check.php">
					<div class="panel panel-default">
						<table class="table">
						    <tr>
						    	<td><strong>ID</strong></td>
								<td><strong>Nombre del Huesped</strong></td>
								<td><strong>Fecha Inicio</strong></td>
								<td><strong>Fecha Fin</strong></td>
							</tr>
							<?php
							include 'conexion.php';
							$result = mysql_query("SELECT * FROM reserva_propiedad WHERE id_propiedad = $_POST[reservas]");
							while ($tabla = mysql_fetch_array($result)){
								$result2 = mysql_query("SELECT * FROM usuario WHERE id_usuario = $tabla[id_huesped]");
								$usuario = mysql_fetch_array($result2);

							?>
							<tr>
								<td> <?php echo $tabla["id_reserva_propiedad"];?></td>
								<td> <?php echo $usuario["nombre_usuario"];?></td>
								<td> <?php echo $tabla["fecha_inicio_reserva"];?></td>
								<td> <?php echo $tabla["fecha_fin_reserva"];?></td>
								<td> <button type="submit" name="aceptar" id="aceptar" onclick="return confirm('Esta seguro que desea aceptar esta reserva?')" value="<?php echo htmlspecialchars($tabla["id_reserva_propiedad"]);?>" class="btn btn-success btn-group-xs">Aceptar</button> </td>
								<td> <button type="submit" name="rechazar" id="rechazar" onclick="return confirm('Esta seguro que desea rechazar esta reserva?')" value="<?php echo htmlspecialchars($tabla["id_reserva_propiedad"]);?>" class="btn btn-danger btn-group-xs">Rechazar</button> </td>
							</tr>
							<?php
							}
							?>
						</table>
					</div>
				</form>
		</div>

    	<script src="js/jquery.js"></script>
    	<script src="js/bootstrap.min.js"></script>
  	</body>
</html>
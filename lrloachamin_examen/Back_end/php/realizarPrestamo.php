<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
	<?php
	require_once("../clases/conexion.php");
	require_once("../clases/usuario.php");
	require_once("../clases/prestamo.php");
	session_start();
	/*
	echo "<pre>";
	print_r($_SESSION['prestamos']);
	echo "</pre>";
	*/

if(isset($_GET['d'])){

$dato = $_GET['d'];
		//	echo $dato;exit;
			$tmp = explode("/", $dato);
			
			$id = $tmp[0];
	
$objPrestamo = $_SESSION['prestamos'][$id];
}
	
	//echo "el codigo es".$objPrestamo[0]->getCodigoSocio();
	
	$html='
	
	<center>
	<h2>BIENVENIDO SUS PRESTAMOS SON:</h2>
	<a href="accionesPrestamo.php?d=new/'.$id.'">Nuevo Prestamo</a></center>
	<table border="1" align="center">
	
	<tr class="table-success">
	<th>Codigo Socio</th>
	<th>Codigo Libro</th>
	<th>Codigo Ejemplar</th>
	<th>Fecha prestamo</th>
	<th>Fecha decolucion real</th>
	<th>Fecha devolver</th>
	<th colspan="3">Acciones</th>
	
	</tr>';
	for($i=0;$i<count($objPrestamo);$i++){
		$html.='<tr>
		<td>'.$objPrestamo[$i]->getCodigoSocio().'</td>
		<td>'.$objPrestamo[$i]->getCodigoLibro().'</td>
		<td>'.$objPrestamo[$i]->getCodigoEjemplar().'</td>
		<td>'.$objPrestamo[$i]->getFechaPrestamo().'</td>
		<td>'.$objPrestamo[$i]->getFechaDevolucionReal().'</td>
		<td>'.$objPrestamo[$i]->getFechaDevolver().'</td>
		<td><a href="#">Ver</a></td>
		<td><a href="#">Editar</a></td>
		<td><a href="#">Eliminar</a></td>
		</tr>';
		
	
	}
	$html.='</table>
	
<center><a href="mostrarLibro.php?d=detail/'.$id.'">Regresar</a></center>';
	echo $html;
	
	?>
</body>
</html>
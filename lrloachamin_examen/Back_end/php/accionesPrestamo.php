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
	require_once("../clases/prestamo.php");

	$prestamo=new prestamo();
//$user=$_GET['d'];
	

	require_once("../clases/conexion.php");
	//require_once("validar.php");
	
	$cn=conectar();	
	//$usuario=new usuario($cn);
	/*
	echo "<pre>";
	print_r($_GET);
	echo "</pre>";
	*/
	/*
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	*/
		
	if(isset($_GET['d'])){		
			$tmp=$_GET['d'];
			$tmp = explode("/", $tmp);
			$op = $tmp[0];
			$id = $tmp[1];
		//echo $op;
		
		
		switch($op){
			case "new":
				
				echo "<center><h2>PRESTAMOS</h2></center>";
				echo $prestamo->crear_prestamo_form($id);		
				break;
				
			
				
		}		
	
	}elseif($_POST){
	
			if(isset($_POST['Guardar']) && $_POST['op']=="add"){
			$prestamo->save_prestamo();
			
			}
		
	
		
	}
	?>
</body>
</html>
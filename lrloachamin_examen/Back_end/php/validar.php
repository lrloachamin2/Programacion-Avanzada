<?php
	require_once('../clases/conexion.php');
require_once('../clases/usuario.php');
require_once('../clases/prestamo.php');
	$usuario = $_POST['codigo_usuario'];
	echo $usuario;
	$clave = $_POST['clave'];

	//Conectar a la base de datos
	$cn=conectar();

	$consulta = "SELECT * FROM usuario WHERE CODIGO_USUARIO =$usuario and CLAVE =$clave";
	$res=$cn->query($consulta);	
	$filas = $res->num_rows;
	
	if($filas>0){
	
		while($reg=$res->fetch_array()){
			echo $reg[0];
			$consulta="select USUARIO_SOCIO FROM socio where CODIGO_SOCIO='$reg[0]'";
			$res=$cn->query($consulta);
			while($user=$res->fetch_array()){
				$tipoUser=$user[0];
			}
			if($tipoUser=="ADM"){
				
			header("location:indexAdm.php?op=".$usuario);
			
			}else{
				session_start();
				
				$prestamo=new prestamo($usuario);
				$_SESSION['prestamos']=$prestamo->get_array_Prestamos($usuario);
				
				header("location:mostrarLibro.php?d=detail/".$usuario);		
				
			}
					
		}
		
		//header("location:verNotebook.php?op=".$usuario);
	}
	else{
		echo "incorrecto";
		//echo "Error en la autentificación";
		//header("location:ErrorAutentificacion.html");
	}

	


?>
<?php

require_once("../clases/conexion.php");
require_once("../clases/usuario.php");
session_start();
$conexion=conectar();

$cedula_socio=$_POST['txtCedula'];
$usuario_socio=$_POST['txtUsuario'];
$nombre_socio=$_POST['txtNombre'];
$apellido_socio=$_POST['txtApellido'];
$telefono_socio=$_POST['txtTelefono'];
$clave=$_POST['txtPass'];




	$socio=new usuario($conexion,$cedula_socio,$usuario_socio,$nombre_socio,$apellido_socio,$telefono_socio,$clave);
	
if($socio->getUsuario()){
	echo "El usuario ya esta registrado";
	
	
}else{
	$socio->save_usuario();
	header("location: cerrar.php");
	
	
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulario de Login</title>
    <link rel="stylesheet" href="Recursos/MisEstilos.css">
   </head>
  
  <body>
	<form name="FormaLogin" action="../Back_end/php/validar.php" method="POST">
      <h2>Formulario de Login</h2>
      <?php
		echo combo();
		
		?>
		
      <input type="password" name="clave" placeholder="&#128272; Contraseña">
      <input type="submit" name="submit" value="submit">
    </form>
	  
	  <?php
	  function combo(){
		  $conexion = mysqli_connect("localhost", "root", "123", "biblioteca");
		$consulta = "SELECT CODIGO_SOCIO,CONCAT_WS(' ',NOMBRE_SOCIO,APELLIDO_SOCIO) AS nombres FROM biblioteca.socio;";
		$resultado = mysqli_query($conexion, $consulta);
		
		 //0 si no coincide, 1 o + si concidio

	
	
		 $html='<select name="codigo_usuario" style="width:100%;height:40px;">';
		while ($reg = mysqli_fetch_array($resultado)) {    
			$html.='<option value='.$reg[0].'>'.$reg[1].'</option>';
        }
		  $html.='<select>';
		
		return $html;

	
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		  
		  
	  }
	  
	  ?>

  </body>
	
	
</html>

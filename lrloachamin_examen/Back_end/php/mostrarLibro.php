<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

	
</head>

<body>

<?PHP
require_once("../clases/libro.php");

$libro=new libro();
//$user=$_GET['d'];
	

	require_once("../clases/conexion.php");
	require_once("../clases/usuario.php");
	//require_once("validar.php");
	
	$cn=conectar();	
	$usuario=new usuario($cn);
	/*
	echo "<pre>";
	print_r($_GET);
	echo "</pre>";
	*/

	
		
	if(isset($_GET['d'])){		
			$tmp=$_GET['d'];
			$tmp = explode("/", $tmp);
			$op = $tmp[0];
			$id = $tmp[1];
		//echo $op;
		
		
		if($op == "detail"){
			if($id=="ADM"){
				echo $libro->get_list_libro_ADM();
				
			}else{
				
				echo $libro->get_list_libro_SOC($id);
				
			}

		}elseif($op=="see"){
			echo $libro->get_detail_libro($id);
					
		
		}elseif($op=="edit"){
			echo $libro->edit_form($id);
			
		
		}elseif($op=="delete"){
			echo $libro->delete_libro($id);
		}
		elseif($op=="new"){
			echo $libro->crear_libro_form();
		}
		
		
		
			
	
	}elseif($_POST){
	
			if(isset($_POST['Guardar']) && $_POST['op']=="act"){
			$libro->editar_libro();
			
			}elseif(isset($_POST['Guardar']) && $_POST['op']=="crear"){
			$libro->save_libro();
			}
			else{
			echo "no entro";
			
			}
		
	
		
	}else{
		
			
			$op=$_GET['consulta'];
			switch ($op) {
			case "libros":
					echo "libros";
					$consulta="SELECT count(CODIGO_LIBRO) FROM biblioteca.libro;";
					$html='<table>
					<tr>
					<th>Libros biblioteca</th>
					</tr>';
					$html.=$libro->consulta_libros($consulta);
					$html.='</table>
					<a href=mostrarLibro.php?d=detail/ADM>Volver</a>';
					echo $html;
					
					
				
			break;					/***************************************************************************/
			case "ejemplares":
					$consulta="SELECT count(CODIGO_EJEMPLAR) as numero_ejemplares FROM biblioteca.ejemplar;";
					$html='<table>
					<tr>
					<th>Ejemplares biblioteca</th>
					</tr>';
					$html.=$libro->consulta_libros($consulta);
					$html.='</table>
					<a href=mostrarLibro.php?d=detail/ADM>Volver</a>';
					echo $html;
				
			break;
		/***************************************************************************/
			case "editados":
					$consulta='Select * from prestamo where codigo_libro in (select codigo_libro from libro where
editorial_libro like "Norma");';
			$html='<table>
					<tr>
					<th>Libros Prestados editados por norma</th>
					
					</tr>
					<tr>
					<td>Codigo Socio</td>
					<td>Codigo Libro</td>
					<td>Codigo Ejemplar</td>
					<td>Fecha del Prestamo</td>
					<td>Fecha Devolucion Real</td>
					<td>Fecha Devolver</td>
					</tr>';
					
					$html.=$libro->consulta_librosPrestados($consulta);
					$html.='</table>
					<a href=mostrarLibro.php?d=detail/ADM>Volver</a>';
			echo $html;
			break;
	/***************************************************************************/
			case "nuevos":
					$consulta="select ej.CODIGO_LIBRO, li.titulo_libro from ejemplar ej, libro li where ej.CODIGO_LIBRO
= li.CODIGO_LIBRO and ej.CODIGO_LIBRO not in (select ej.CODIGO_LIBRO from
ejemplar where ej.deteriorado=1);";
					$html='<table>
					<tr>
					<th>Libros cuyo total de ejemplares estan nuevo</th>
					
					</tr>
					<tr>
					<td>Codigo Libro</td>
					<td>Titulo Libro</td>
					
					</tr>';
					
					$html.=$libro->consulta_librosNuevos($consulta);
					$html.='</table>
					
					<a href=mostrarLibro.php?d=detail/ADM>Volver</a>';
			echo $html;
					
					
			
			break;
}
		}
	/*
	if(isset($_GET['d'])){		
			$tmp=$_GET['d'];
			$tmp = explode("/", $tmp);
			$op = $tmp[0];
			$id = $tmp[1];
			echo $op;
		
		if($op == "act"){
			
				echo $usuario->get_detail_user($id);
		}
		elseif($op == "edit"){
			
				echo $usuario->get_detail_user($id);
		}
		elseif($op == "delete"){
				echo $usuario->delete_persona($id);
		}
	}else{
		if(isset($_POST['Guardar']) && $_POST['op']=="update"){
			$usuario->update_usuario();
		}else{
			
			echo $usuario->get_list_user();
		}
			
	}

	/*
if($user=="new"){
	
	$libro->crear_libro_form();
	
	
}
	
elseif($user=="ADM"){
echo "Su usuario es ".$user;
echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
     <select>
	<option>Cuantos libros hay en la biblioteca</option>
	<option>Cuantos ejemplares hay en la biblioteca</option>
	<option>Cuantos libros editados por NORMA fueron prestados</option>
	<option>Nombres de los libros cuyos ejemplares están nuevos</option>
	</select>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Prestamos</a>
      </li>
    </ul>
  </div>
</nav>';
echo $libro->get_list_libro_ADM();
echo "<a href='cerrarSesion.php'>Cerrar Session</a>";
}elseif(isset($_GET['crear']) && $_GET['op']=="create"){
			echo $libro->get_list_libro_ADM();

}else{
	echo "Su usuario es ".$user;
	echo $libro->get_list_libro_SOC();
	echo "<a href='cerrarSesion.php'>Cerrar Session</a>";
	
}
	*/


?>
</body>
	
</html>
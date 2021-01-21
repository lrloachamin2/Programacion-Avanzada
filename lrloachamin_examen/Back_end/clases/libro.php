	
<?php
require_once("conexion.php");
	class libro{
		
		
		private $codigo_libro;
		private $titulo_libro;
		private $editorial_libro;
		private $anio_escrito;
		private $anio_edicion;
		private $isbn;
		private $cn;
		/*
		function __construct($codigo_libro,$titulo_libro,$editorial_libro,$anio_escrito,$anio_edicion,$isbn){
		$this->cedula_socio=$codigo_libro;
		$this->usuario_socio=$titulo_libro;
		$this->nombre_socio=$editorial_libro;
		$this->apellido_socio=$anio_escrito;
		$this->telefono_socio=$anio_edicion;
		$this->clave=$isbn;
	}
		
		*/
		function __construct()
		{
			$this->cn=conectar();
			
		}
		function get_list_libro_ADM(){
			
		
		$conexion = mysqli_connect("localhost", "root", "123", "biblioteca");
		$consulta = "SELECT CODIGO_LIBRO AS codigo,TITULO_LIBRO as titulo,EDITORIAL_LIBRO as editorial,ANIO_ESCRITO as aEscrito,ANIO_EDICION as aEdicion,ISBN as isbn
                    FROM libro;";
		$resultado = mysqli_query($conexion, $consulta);
		
		 //0 si no coincide, 1 o + si concidio
			
		$html='<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
    	<form action="mostrarLibro.php?d=consu/ADM">
		<select name="consulta">
		<option value="libros">Cuantos libros hay en la biblioteca</option>
		<option value="ejemplares">Cuantos ejemplares hay en la biblioteca</option>
		<option value="editados">Cuantos libros editados por NORMA fueron prestados</option>
		<option value="nuevos" >Nombres de los libros cuyos ejemplares están nuevos</option>
		<input type="submit" value="consultar">
	</form>
	</select>

  			</nav>
		</div>';

		$html.='<center><a href="mostrarLibro.php?d=new/ADM" >Crear</a></center>
		<table border=1  align="center">
		
		<tr class="table-active" align="center">
		<th>Codigo Libro</th>
		<th>Titulo Libro</th>
		<th>Editorial Libro</th>
		<th>Año del Libro</th>
		<th>Año edicion </th>
		<th>ISBN </th>
		<th colspan="3">ACCIONES </th>
		
		</tr>';
		while ($reg = mysqli_fetch_array($resultado)) {
            $html.='<tr><td>'.$reg[0].'</td>
			<td>'.$reg[1].'</td>
			<td>'.$reg[2].'</td>
			<td>'.$reg[3].'</td>
			<td>'.$reg[4].'</td>
			<td>'.$reg[5].'</td>
			<td class="table-info"><a href="../php/mostrarLibro.php?d=see/'.$reg[0].'">Ver</a></td>
			<td class="table-success" ><a href="../php/mostrarLibro.php?d=edit/'.$reg[0].'">Editar</a></td>
			<td class="table-warning""><a href="../php/mostrarLibro.php?d=delete/'.$reg[0].'">Eliminar</a></td>
			
			</tr>';
        }
		$html.='</table>
		<center><a href="indexADM.php?d=new/ADM" >Salir</a></center>';

		mysqli_free_result($resultado);
		mysqli_close($conexion);
			
		return $html;
			
			
		}
		function get_list_libro_SOC($id){
		
		$conexion = mysqli_connect("localhost", "root", "123", "biblioteca");
		$consulta = "SELECT CODIGO_LIBRO AS codigo,TITULO_LIBRO as titulo,EDITORIAL_LIBRO as editorial,ANIO_ESCRITO as aEscrito,ANIO_EDICION as aEdicion,ISBN as isbn
                    FROM libro;";
		$resultado = mysqli_query($conexion, $consulta);
		
		 //0 si no coincide, 1 o + si concidio

		$html='
		<center><h2>BIBLIOTECA</h2></center>
		<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<center><a href="realizarPrestamo.php?d='.$id.'">Prestamo</a></center>
		</nav>
		</div>
		<table border=1  align="center">
		
		<tr class="table-active" align="center">
		<th>Codigo Libro</th>
		<th>Titulo Libro</th>
		<th>Editorial Libro</th>
		<th>Año del Libro</th>
		<th>Año edicion </th>
		<th>ISBN </th>
		<th>ACCIONES </th>
		
		</tr>';
		while ($reg = mysqli_fetch_array($resultado)) {
            $html.='<tr><td>'.$reg[0].'</td>
			<td>'.$reg[1].'</td>
			<td>'.$reg[2].'</td>
			<td>'.$reg[3].'</td>
			<td>'.$reg[4].'</td>
			<td>'.$reg[5].'</td>
			<td><a href="../php/mostrarLibro.php?d=see/'.$reg[0].'">Ver</a></td>			
			</tr>';
        }
		$html.='<table>
		
		<center><a href="cerrarSesion">Cerra Sesion</a></center>';

		mysqli_free_result($resultado);
		mysqli_close($conexion);
			
			return $html;
			
			
		}
		
		
	
	public function get_detail_libro($id){
		
		$conexion = mysqli_connect("localhost", "root", "123", "biblioteca");
		$consulta = "SELECT CODIGO_LIBRO AS codigo,TITULO_LIBRO as titulo,EDITORIAL_LIBRO as editorial,ANIO_ESCRITO as aEscrito,ANIO_EDICION as aEdicion,ISBN as isbn
                    FROM libro where CODIGO_LIBRO='$id' ;";
		$resultado = mysqli_query($conexion, $consulta);
		
		 //0 si no coincide, 1 o + si concidio

		$html='
		<center><h2>Detalle Libro</h2></center>
		<table border=1 align="center">
		
		<tr class="table-success">
		<th>Codigo Libro</th>
		<th>Titulo Libro</th>
		<th>Editorial Libro</th>
		<th>Año del Libro</th>
		<th>Año edicion </th>
		<th>ISBN </th>
		
		</tr>';
		while ($reg = mysqli_fetch_array($resultado)) {
            $html.='<tr><td>'.$reg[0].'</td>
			<td>'.$reg[1].'</td>
			<td>'.$reg[2].'</td>
			<td>'.$reg[3].'</td>
			<td>'.$reg[4].'</td>
			<td>'.$reg[5].'</td>
			
			</tr>';
        }
		$html.='</table>
		<center><a href="'.$_SERVER['HTTP_REFERER'].'">Volver</a></center>';

		mysqli_free_result($resultado);
		mysqli_close($conexion);
			
		return $html;
				
		}
		
		public function crear_libro_form(){
		 //0 si no coincide, 1 o + si concidio
			$op="crear";

		$html='<table border=1 align="center" >
		
		';
	
            $html.='<form action="mostrarLibro.php" method="post">
			<input type="hidden" name="op" value="' . $op  . '">
			<tr class="table-primary" ><th colspan="2">AGREGAR LIBRO</th></tr>
			<tr><td>Titulo</td><td><input type="text" name="titulo"></td></tr>
			<tr><td>Editorial</td><td><input type="text" name="editorial"></td></tr>
			<tr><td>Año</td><td><input type="text"  name="anio"></tr>
			<tr><td>Año de edicion</td><td><input type="text"  name="anioEdicion"></td></tr>
			<tr><td>ISBN</td><td><input type="text"  name="isbn"></td></tr>
			
			<tr><td colspan="2">
			<center><input type="submit" value="crear" name="Guardar" class="btn btn-primary">
			
			</center></td><tr>
			</form>
			';
        
		$html.='<table>';
		echo $html;

					
		}
		
		public function save_libro(){
			
			echo $this->titulo_libro = $_POST['titulo'];
			echo  $this->editorial_libro = $_POST['editorial'];
			$this->anio_escrito = $_POST['anio'];
			$this->anio_edicion = $_POST['anioEdicion'];
			$this->isbn=$_POST['isbn'];
			
			
		$consulta=	"INSERT INTO `libro` (`CODIGO_LIBRO`, `TITULO_LIBRO`, `EDITORIAL_LIBRO`, `ANIO_ESCRITO`, `ANIO_EDICION`, `ISBN`) VALUES (NULL, '$this->titulo_libro', '$this->editorial_libro', '$this->anio_escrito', '$this->anio_edicion', '$this->isbn');";
		
		if($this->cn->query($consulta)){
			echo $this->_message_ok("guardo");
				
				
		}else{
			echo $this->_message_error("guardo");
				
				
		}
			
			
		}
		public function editar_libro(){
			
			
		
		$conexion = mysqli_connect("localhost", "root", "123", "biblioteca");	
			
		$this->titulo_libro = $_POST['titulo'];
		$this->editorial_libro = $_POST['editorial'];
		$this->anio_escrito = $_POST['anio'];
		$this->anio_edicion = $_POST['anioEdicion'];
		$id=$_POST['id'];
			
			echo $id;
			
		
			
		$consulta=	"UPDATE `libro` SET `TITULO_LIBRO` = '$this->titulo_libro', `EDITORIAL_LIBRO` = '$this->editorial_libro', `ANIO_ESCRITO` = '$this->anio_escrito', `ANIO_EDICION` = '$this->anio_edicion' WHERE `libro`.`CODIGO_LIBRO` = $id;";
		
		if($this->cn->query($consulta)){
			echo $this->_message_ok("edito");
				
				
		}else{
			echo $this->_message_error("edito");
				
				
		}	
		
			
		}
		function numero_Libros(){
			
			
			
			
			
			
		}
		function edit_form($id){
			
		$conexion = mysqli_connect("localhost", "root", "123", "biblioteca");
		$consulta = "SELECT CODIGO_LIBRO AS codigo,TITULO_LIBRO as titulo,EDITORIAL_LIBRO as editorial,ANIO_ESCRITO as aEscrito,ANIO_EDICION as aEdicion,ISBN as isbn
                    FROM libro  where CODIGO_LIBRO='$id' ;";
		$resultado = mysqli_query($conexion, $consulta);
			$op="act";
		
		 //0 si no coincide, 1 o + si concidio

		$html='<table border=1>
		
		';
		while ($reg = mysqli_fetch_array($resultado)) {
            $html.='<form action="mostrarLibro.php" method="post">
			<input type="hidden" name="op" value="' . $op  . '">
			<tr><td>ID</td><td><input type="hidden" value='.$id.' name="id"></td></tr>
			<tr><td>Titulo</td><td><input type="text" value='.$reg[1].' name="titulo"></td></tr>
			<tr><td>Editorial</td><td><input type="text" value='.$reg[2].' name="editorial"></td></tr>
			<tr><td>Año</td><td><input type="text" value='.$reg[3].' name="anio"></tr>
			<tr><td>Año de edicion</td><td><input type="text" value='.$reg[4].' name="anioEdicion"></td></tr>
			<tr><td colspan=2><input type="submit" value="editar" name="Guardar"></td><tr>
			</form>
			';
        }
		$html.='<table>';
		echo $html;

	
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		}
		
	public function consulta_libros($sql){
		$res=$this->cn->query($sql);
		while($row=$res->fetch_array()){
			
			$html='<tr><td>'.$row[0].'</td></tr>';
				
		}
		return $html;
	}
		
	public function consulta_librosPrestados($sql){
		$res=$this->cn->query($sql);
		$html="";
		while($row=$res->fetch_array()){
			
			$html.='<tr>
			<td>'.$row[0].'</td>
			<td>'.$row[1].'</td>
			<td>'.$row[2].'</td>
		<td>'.$row[3].'</td>
		<td>'.$row[4].'</td>
		<td>'.$row[5].'</td>
			</tr>
			
			';
				
		}
		
		return $html;
		
		
	}
		public function consulta_librosNuevos($sql){
		$res=$this->cn->query($sql);
		$html="";
		while($row=$res->fetch_array()){
			
			$html.='<tr>
			<td>'.$row[0].'</td>
			<td>'.$row[1].'</td>
			
			</tr>
			
			';
				
		}
		
		return $html;
		
		
	}
		
	public function delete_libro($id){
		$sql = "DELETE FROM `libro` WHERE `libro`.`CODIGO_LIBRO` = $id;";
		
			
		if($this->cn->query($sql)){
			echo $this->_message_ok("eliminar");
		}else{
			echo $this->_message_error("eliminar");
		}	
	
		
	}
	private function _message_error($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>Error al ' . $tipo . '. Favor contactar a .................... </th>
			</tr>
			<tr>
				<th><a href="mostrarLibro.php?d=detail/ADM">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
	
	private function _message_ok($tipo){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>El registro se  ' . $tipo . ' correctamente</th>
			</tr>
			<tr>
				<th><a href="mostrarLibro.php?d=detail/ADM">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
		
		
		
	}
	
	
	
?>

<?php
require_once("conexion.php");
class prestamo{
	private $codigo_socio;
	private $codigo_libro;
	private $codigo_ejemplar;
	private $fecha_prestamo;
	private $fecha_devolucion_real;
	private $fecha_devolver;
	private $cn;

	
	function __construct($codigo_socio=NULL,$codigo_libro=NULL,$codigo_ejemplar=NULL,$fecha_prestamo=NULL,$fecha_devolucion_real=NULL,$fecha_devolver=NULL){
		$this->codigo_socio=$codigo_socio;
		$this->codigo_libro=$codigo_libro;
		$this->codigo_ejemplar=$codigo_ejemplar;
		$this->fecha_prestamo=$fecha_prestamo;
		$this->fecha_devolucion_real=$fecha_devolucion_real;
		$this->fecha_devolver=$fecha_devolver;
		$this->cn=conectar();
		
	}
	
	public function getCodigoSocio(){
			
		return $this->codigo_socio;	
		
	}
	
	public function getCodigoLibro(){
			
		return $this->codigo_libro;	
	}
	
	public function getCodigoEjemplar(){
			
		return $this->codigo_ejemplar;	
	}
	
	public function getFechaPrestamo(){
			
		return $this->fecha_prestamo;	
	}
	
	public function getFechaDevolucionReal(){
			
		return $this->fecha_devolucion_real;	
	}
	public function getFechaDevolver(){
			
		return $this->fecha_devolver;	
	}
	
	public function get_array_Prestamos($id){
		$con=conectar();
		$prestamo=array();	
		$prestamo_array=array();
		$sql="SELECT * FROM biblioteca.prestamo where CODIGO_SOCIO=$id";
		$res = $con->query($sql);
		$i=0;
		while($row = $res->fetch_array()){
			$prestamoUser=new prestamo($row[0],$row[1],$row[2],$row[3],$row[4],$row[0]);
			$prestamo[$i]=$prestamoUser;
			$i++;

		}
		$prestamo_array[$id]=$prestamo;
		return $prestamo_array;	
	}
	public function crear_prestamo_form($id){
		 //0 si no coincide, 1 o + si concidio
			$op="add";

		$html='<table border=1 align="center">
		<tr class="table-primary" ><th colspan="2">Realizar Prestamo</th></tr>
		';
	
            $html.='<form action="accionesPrestamo.php" method="post">
			<input type="hidden" name="op" value="' . $op  . '">
			<input type="hidden" name="id" value="' . $id . '">
			<tr><td>Codigo libro</td><td><input type="number" name="codLibro"></td></tr>
			<tr><td>Codigo Ejemplar</td><td><input type="number" name="codEjemplar"></td></tr>
			<tr><td>Fecha Prestamo</td><td><input type="date"  name="fechPrestamo"></tr>
			<tr><td>Fecha Devolucion real</td><td><input type="date"  name="fechaDevolucionReal"></td></tr>
			<tr><td>Fecha Devolver</td><td><input type="date"  name="FechaDevolver"></td></tr>
			
			<tr><td colspan=2><input type="submit" value="crear" name="Guardar"></td><tr>
			</form>
			';
        
		$html.='<table>
		<center><a href="realizarPrestamo.php?d='.$id.'">Regresar</a><center>';
		return $html;

					
		}
	public function save_prestamo(){
			
		 $this->codigo_libro= $_POST['codLibro'];
		 $this->codigo_ejemplar = $_POST['codEjemplar'];
			$this->fecha_prestamo = $_POST['fechPrestamo'];
			$this->fecha_devolucion_real = $_POST['fechaDevolucionReal'];
			$this->fecha_devolver=$_POST['FechaDevolver'];
		$this->codigo_socio=$_POST['id'];
			
			
		$consulta=	"INSERT INTO `prestamo` (`CODIGO_SOCIO`, `CODIGO_LIBRO`, `CODIGO_EJEMPLAR`, `FECHA_PRESTAMO`, `FECHA_DEVOLUCION_REAL`, `FECHA_DEVOLVER`) VALUES ('$this->codigo_socio', '$this->codigo_libro', '$this->codigo_ejemplar', '$this->fecha_prestamo', '$this->fecha_devolucion_real ', '$this->fecha_devolver');";
		
		if($this->cn->query($consulta)){
			echo $this->_message_ok("guardo",$this->codigo_socio);
				
				
		}else{
			echo $this->_message_error("guardo",$this->codigo_socio);
				
				
		}
		
	}
	private function _message_error($tipo,$id){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>Error al ' . $tipo . '. Favor contactar a .................... </th>
			</tr>
			<tr>
				<th><a href="realizarPrestamo.php?d='.$id.'">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
	
	private function _message_ok($tipo,$id){
		$html = '
		<table border="0" align="center">
			<tr>
				<th>El registro se  ' . $tipo . ' correctamente</th>
			</tr>
			<tr>
				<th><a href="realizarPrestamo.php?d='.$id.'">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}
	
	
}

?>



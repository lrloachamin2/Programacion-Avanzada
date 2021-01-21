<?php
require_once("conexion.php");
class usuario{
	private $codigo_socio;
	private $cedula_socio;
	private $usuario_socio;
	private $nombre_socio;
	private $apellido_socio;
	private $telefono_socio;
	private $clave;
	private $con;
	
	function __construct($codigo_socio=NULL,$cedula_socio=NULL,$usuario_socio=NULL,$nombre_socio=NULL,$apellido_socio=NULL,$telefono_socio=NULL,$clave=NULL){
		$this->codigo_socio=$codigo_socio;
		$this->cedula_socio=$cedula_socio;
		$this->usuario_socio=$usuario_socio;
		$this->nombre_socio=$nombre_socio;
		$this->apellido_socio=$apellido_socio;
		$this->telefono_socio=$telefono_socio;
		$this->clave=$clave;
		$this->con = conectar();
	}
	public function getUsuario()
		{
		
		$usario = array();
		$cedula=$this->cedula_socio;
		$consulta = "SELECT * FROM socio where CEDULA_SOCIO='$cedula'";
		$res=$this->con->query($consulta );
		$filas=$res->num_rows;
	
		if($filas>0){
			
			return true;
		
		}
		else{
			return false;
		
		}		
			
		}
	public function getCedulaSocio(){
			
		return $this->cedula_socio;	
	}
	
	public function save_usuario(){
		
		$cedula=$this->cedula_socio;
		$consulta = "INSERT INTO socio VALUES (NULL, '$this->cedula_socio', '$this->usuario_socio', '$this->nombre_socio', '$this->apellido_socio', '$this->telefono_socio');";
		$resultado =$this->con->query($consulta);
	}
	
	public function get_list_user(){
		
		$consulta = "SELECT  * FROM socio";
		$resultado = $this->con->query($consulta);

		$html='<table border=1 align="center" >
		<tr>
		<th colspan="8" class="table-success" >
		SOCIOS
		</th>
		</tr>
		<tr class="table-active">
		
		<th>Cedula Socio</th>
		<th>Usuario Socio</th>
		<th>Nombre socio</th>
		<th>Apellido Socio</th>
		<th>Telefono socio</th>
		<th colspan="3">Acciones</th>
		
		
		</tr>';
		
		
		while ($reg = $resultado->fetch_array()) {
			$d_act = "act/" .$reg[0];
			$d_delete="delete/" .$reg[0];
			
            $html.='
			<td>'.$reg[1].'</td>
			<td>'.$reg[2].'</td>
			<td>'.$reg[3].'</td>
			<td>'.$reg[4].'</td>
			<td>'.$reg[5].'</td>
			
			<td><a href="../php/verLibro.php?op='.$d_act.'">Ver</a></td>
			<td><a href="../php/verUsuario.php?d='.$d_act.'">Editar</a></td>
			<td><a href="../php/verUsuario.php?d='.$d_delete.'">Eliminar</a></td>
			
			</tr>';
        }
		$html.='<table>';
			return $html;
		
		
	}
	public function get_detail_user($id){
		$sql = "SELECT  CEDULA_SOCIO,USUARIO_SOCIO,NOMBRE_SOCIO,APELLIDO_SOCIO,TELEFONO_SOCIO FROM socio where CODIGO_SOCIO=$id";		
			$res = $this->con->query($sql);
			$row = $res->fetch_assoc();
			
			$num = $res->num_rows;
            if($num==0){
                $mensaje = "tratar de actualizar el vehiculo con id= ".$id;

            }else{   
			
                // -- //
			$this->cedula_socio= $row['CEDULA_SOCIO'];
			$this->usuario_socio = $row['USUARIO_SOCIO'];
			$this->nombre_socio = $row['NOMBRE_SOCIO'];
			$this->apellido_socio= $row['APELLIDO_SOCIO'];
			$this->telefono_socio = $row['TELEFONO_SOCIO'];
			$op="update";
			}
		
		
		$html = '
		<form name="vehiculo" method="POST" action="verUsuario.php?=update" enctype="multipart/form-data">
		<input type="hidden" name="id" value="' . $id  . '">
		<input type="hidden" name="op" value="' . $op  . '">
		
			<table border="0" align="center" >
				<tr>
					<th colspan="2" class="table-active">DATOS USUARIOS</th>
				</tr>
				<tr>
					<td>Cedula Persona</td>
					<td><input type="text" size="15" name="CedulaPersona" value="' . $this->cedula_socio. '" required></td>
				</tr>
				<tr>
					<td>Usuario Socio</td>
					<td><input type="text" size="15" name="UsuarioSocio" value="' . $this->usuario_socio. '" required></td>
				</tr>
					
				<tr>
					<td>Nombre Socio</td>
					<td><input type="text" size="15" name="NombreSocio" value="' . $this->nombre_socio. '" required></td>
				</tr>
				<tr>
					<td>Apellido Socio</td>
					<td><input type="text" size="15" name="ApellidoSocio" value="' . $this->apellido_socio. '" required></td>
				</tr>
				<tr>
			
					<td>Telefono Socio</td>
							<td><input type="text" size="15" name="TelefonoSocio" value="' . $this->telefono_socio. '" required></td>
				</tr>
				<tr>
				<td>
				<input type="submit" value="editar" name="Guardar">
				</td>
				</tr>
				</form>
																
			</table>';

				
				return $html;
		
	}
	public function update_usuario(){
		$this->cedula_socio = $_POST['CedulaPersona'];
		$this->usuario_socio = $_POST['UsuarioSocio'];
		$this->nombre_socio = $_POST['NombreSocio'];
		$this->apellido_socio = $_POST['ApellidoSocio'];
		$this->telefono_socio= $_POST['TelefonoSocio'];	
		$this->codigo_socio=$_POST['id'];
		echo $this->codigo_socio;
		
	$sql="UPDATE `socio` SET `CEDULA_SOCIO` = '$this->cedula_socio', `USUARIO_SOCIO` = '$this->usuario_socio', `NOMBRE_SOCIO` = '$this->nombre_socio', `APELLIDO_SOCIO` = '$this->apellido_socio', `TELEFONO_SOCIO` = '$this->telefono_socio' WHERE `socio`.`CODIGO_SOCIO` = $this->codigo_socio";
		//echo $sql;
		//exit;
		if($this->con->query($sql)){
			echo "MODIFICO";
		}else{
			echo "ERROR";
		}
											
	}
	public function delete_persona($id){
		$sql = "DELETE FROM `socio` WHERE `socio`.`CODIGO_SOCIO`=$id;";
			
		if($this->con->query($sql)){
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
				<th><a href="verUsuario.php">Regresar</a></th>
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
				<th><a href="verUsuario.php">Regresar</a></th>
			</tr>
		</table>';
		return $html;
	}

	
}
?>
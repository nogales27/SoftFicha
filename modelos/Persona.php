<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Persona
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idarea_medica,$tipo_persona,$ci,$nombre,$apellidos,$sexo,$fecha_nac,$edad,$direccion,$telefono,$telefono2,$nromatricula)
	{
		$sql="INSERT INTO persona (idarea_medica,tipo_persona,ci,nombre,apellidos,sexo,fecha_nac,edad,direccion,telefono,telefono2,nromatricula,condicion)
		VALUES ('$idarea_medica','$tipo_persona','$ci','$nombre','$apellidos','$sexo','$fecha_nac','$edad','$direccion','$telefono','$telefono2','$nromatricula','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idpersona,$idarea_medica,$tipo_persona,$ci,$nombre,$apellidos,$sexo,$fecha_nac,$edad,$direccion,$telefono,$telefono2,$nromatricula)
	{
		$sql="UPDATE persona SET idarea_medica='$idarea_medica', tipo_persona='$tipo_persona',ci='$ci',nombre='$nombre',apellidos='$apellidos',sexo='$sexo',fecha_nac='$fecha_nac',edad='$edad',direccion='$direccion',telefono='$telefono',
		telefono2='$telefono2',nromatricula='$nromatricula' WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idpersona)
	{
		$sql="DELETE FROM persona WHERE idpersona='$idpersona'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idpersona)
	{
		$sql="SELECT * FROM persona WHERE idpersona='$idpersona'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listarp()
	{
		$sql="SELECT * FROM persona where tipo_persona='paciente' ";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros 
	public function listarm()
	{
		$sql="SELECT * FROM persona WHERE tipo_persona='medico'";
		return ejecutarConsulta($sql);		
	}
}

?>
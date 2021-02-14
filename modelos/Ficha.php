<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ficha
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idpersona,$idarea_medica,$idusuario,$nroficha,$turno,$fecha)
	{
		$sql="INSERT INTO ficha (idpersona,idarea_medica,idusuario,nroficha,turno,fecha,estado)
		VALUES ('$idpersona','$idarea_medica','$idusuario','$nroficha','$turno','$fecha','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idficha,$idpersona,$idarea_medica,$idusuario,$nroficha,$turno,$fecha)
	{
		$sql="UPDATE ficha SET idpersona='$idpersona',idarea_medica='$idarea_medica',idusuario='$idusuario',nroficha='$nroficha',turno='$turno',fecha='$fecha' WHERE idficha='$idficha'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idficha)
	{
		$sql="UPDATE ficha SET estado='0' WHERE idficha='$idficha'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idficha)
	{
		$sql="UPDATE ficha SET estado='1' WHERE idficha='$idficha'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idficha)
	{
	
		

		$sql="SELECT f.idficha,f.idpersona,p.nombre as paciente,a.idarea_medica,a.especialidad as especialidad,u.idusuario,u.nombre as usuario,f.nroficha,f.turno,f.fecha,f.tipo_comprobante,f.estado
		FROM ficha f INNER JOIN persona p ON f.idpersona=p.idpersona INNER JOIN area_medica a on f.idarea_medica=a.idarea_medica
		inner join usuario u on f.idusuario=u.idusuario where idficha='$idficha'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT f.idficha,f.idpersona,p.nombre as paciente,a.idarea_medica,a.especialidad as especialidad,u.idusuario,u.nombre as usuario,f.nroficha,f.turno,f.fecha,f.tipo_comprobante,f.estado
	     
		 FROM ficha f INNER JOIN persona p ON f.idpersona=p.idpersona INNER JOIN area_medica a on f.idarea_medica=a.idarea_medica
		 inner join usuario u on f.idusuario=u.idusuario " ;
		return ejecutarConsulta($sql);		
	}

	public function fichacabecera($idficha)
	{
		$sql="SELECT f.idficha,f.idpersona,p.nombre as paciente,p.apellidos,p.ci,a.idarea_medica,a.especialidad as especialidad,u.idusuario,u.nombre as usuario,f.nroficha,f.turno,f.fecha,f.estado
	     
		FROM ficha f INNER JOIN persona p ON f.idpersona=p.idpersona INNER JOIN area_medica a on f.idarea_medica=a.idarea_medica
		inner join usuario u on f.idusuario=u.idusuario  WHERE f.idficha='$idficha'";
		return ejecutarConsulta($sql);	
	}
}

?>
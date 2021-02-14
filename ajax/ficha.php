<?php 

if (strlen(session_id()) < 1) 
session_start();
require_once "../modelos/Ficha.php";

$ficha=new Ficha();

$idficha=isset($_POST["idficha"])? limpiarCadena($_POST["idficha"]):"";
$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$idarea_medica=isset($_POST["idarea_medica"])? limpiarCadena($_POST["idarea_medica"]):"";
$idusuario=$_SESSION["idusuario"];
$nroficha=isset($_POST["nroficha"])? limpiarCadena($_POST["nroficha"]):"";
$turno=isset($_POST["turno"])? limpiarCadena($_POST["turno"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";
$tipo_comprobante=isset($_POST["tipo_comprobante"])? limpiarCadena($_POST["tipo_comprobante"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	
		if (empty($idficha)){
			$rspta=$ficha->insertar($idpersona,$idarea_medica,$idusuario,$nroficha,$turno,$fecha);
			echo $rspta ? "Ficha registrado" : "Ficha  registrada";
		}
		else {
			$rspta=$ficha->editar($idficha,$idpersona,$idarea_medica,$idusuario,$nroficha,$turno,$fecha);
			echo $rspta ? "Ficha actualizado" : "Ficha no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ficha->desactivar($idficha);
 		echo $rspta ? "Ficha Desactivado" : "Ficha no se puede desactivar";
	break;

	case 'activar':
		$rspta=$ficha->activar($idficha);
 		echo $rspta ? "Ficha activado" : "Ficha no se puede activar";
	break;

	case 'mostrar':
		$rspta=$ficha->mostrar($idficha);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ficha->listar();
 		//Vamos a declarar un array
 		$data= Array();


		 
		
				
				 
				
	

 		while ($reg=$rspta->fetch_object()){
			
            if ($reg->tipo_comprobante =='Ticket') {
				$url='../reportes/exTicket.php?id=';}
				 else {
				 
				$url='../reportes/exFactura.php?id=';
			}

 			$data[]=array(
 				"0"=>(($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idficha.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idficha.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idficha.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idficha.')"><i class="fa fa-check"></i></button>').
					
					 '<a target="_blank" href="'.$url.$reg->idficha.'">
 				<button class="btn btn-info"> <i class="fa fa-file "> </i> </button> </a> ',
				"1"=>$reg->paciente,
 				"2"=>$reg->especialidad,
 				"3"=>$reg->usuario,
				 "4"=>$reg->nroficha,
				 "5"=>$reg->turno,
				 "6"=>$reg->fecha,
				 "7"=>$reg->tipo_comprobante,
 				"8"=>($reg->estado)?'<span class="label bg-green">Aceptado</span>':
 				'<span class="label bg-red">Anulado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectPaciente":
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$rspta = $persona->listarp();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idpersona . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectEspecialidad":
		require_once "../modelos/Area_Medica.php";
		$persona = new Persona();

		$rspta = $persona->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idarea_medica . '>' . $reg->especialidad . '</option>';
				}
	break;
}
?>
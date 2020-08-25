<?php 
require_once "../modelos/Consultas.php";

$consulta=new Consultas();


switch ($_GET["op"]){
	case 'reporte':
		
		$rspta=$consulta->reporte();
 		
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->codigo,
 				"1"=>$reg->Descripcion,
 				"2"=>$reg->stock
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}

?>
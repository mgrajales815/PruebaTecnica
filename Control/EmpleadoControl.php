<?php

require_once "../Modelo/EmpleadoModelo.php";//Utilizará este archivo

$empleado=new empleados();//crea un nuevo articulo
//carga las variables con los valores recibidos y limpia de caracteres extraños
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$area_id=isset($_POST["area_id"])? limpiarCadena($_POST["area_id"]):"";
$boletin=isset($_POST["boletin"])? limpiarCadena($_POST["boletin"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
//opciones
switch ($_GET["op"])
	{
		case 'guardar'://primer caso
				$rspta=$empleado->insertar($id, $nombre, $email, $sexo, $area_id, $boletin, $descripcion);
				echo $rspta ? "Registro exitoso" : "El empleado no se pudo registrar";
		break;
			
		case 'editar':
				$rspta=$empleado->editar($id, $nombre, $email, $sexo, $area_id, $boletin, $descripcion);
				echo $rspta ? "Empleado actualizado con éxito" : "El empleado no se pudo actualizar";
			
		break;

		case 'mostrar':
			$rspta=$empleado->mostrar($id);
	 		//Codificar el resultado utilizando json
	 		echo json_encode($rspta);
	 	
		break;

		case 'borrar':
			$rspta=$empleado->borrar($id);
	 		echo $rspta ? "Empleado borrado con éxito" : "El empleado no se pudo borrar";
		break;

		case 'listar'://activado por el ajax en el scrip articulos
			$rspta=$empleado->listar();//Carga la rspta con lista de articulos
	 		//Vamos a declarar un array
	 		$data= Array();

	 		while ($reg=$rspta->fetch_object())//mientras exista objeto en la respuesta
	 		{
	 			$data[]=array(//arreglo con los datos de las siete columnas
			 		"0"=>$reg->id,
					"1"=>$reg->nombre,
	 				"2"=>$reg->email,
	 				"3"=>$reg->sexo,
	 				"4"=>$reg->area_id,
	 				"5"=>$reg->boletin,
                    "6"=>$reg->descripcion,
                    "7"=>' <span title="Borrar Empleado"><button class="btn btn-danger" onclick="borrar('.$reg->id.')"><i class="fa fa-close"></i></button></span>'
                );
	 		}
	 		$results = array(//variable con el resultado del arreglo
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data);
	 		echo json_encode($results);//muestra el resultado

		break;
	}
?>
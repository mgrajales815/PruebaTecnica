<?php

require_once "../Modelo/AreasModelo.php";//Utilizará este archivo

$area=new areas();//crea un nuevo articulo
//carga las variables con los valores recibidos y limpia de caracteres extraños
$id=isset($_POST["id"])? limpiarCadena($_POST["id"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
//opciones
switch ($_GET["op"])
	{
		case 'guardar'://primer caso
				$rspta=$area->insertar($id, $nombre, $email, $sexo, $area_id, $boletin, $descripcion);
				echo $rspta ? "Registro exitoso" : "El área no se pudo registrar";
		break;
			
		case 'editar':
				$rspta=$area->editar($id, $nombre, $email, $sexo, $area_id, $boletin, $descripcion);
				echo $rspta ? "Área actualizada con éxito" : "El área no se pudo actualizar";
			
		break;

		case 'mostrar':
			$rspta=$area->mostrar($id);
	 		//Codificar el resultado utilizando json
	 		echo json_encode($rspta);
	 	
		break;

		case 'borrar':
			$rspta=$area->borrar($id);
	 		echo $rspta ? "Área borrada con éxito" : "El área no se pudo borrar";
		break;

		case 'listar'://activado por el ajax en el scrip articulos
			$rspta=$area->listar();//Carga la rspta con lista de articulos
	 		//Vamos a declarar un array
	 		$data= Array();

	 		while ($reg=$rspta->fetch_object())//mientras exista objeto en la respuesta
	 		{
	 			$data[]=array(//arreglo con los datos de las siete columnas
			 		"0"=>$reg->id,
					"1"=>$reg->nombre,
	 				"2"=>' <span title="Borrar área"><button class="btn btn-danger" onclick="borrar('.$reg->id.')"><i class="fa fa-close"></i></button></span>'
                );
	 		}
	 		$results = array(//variable con el resultado del arreglo
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data);
	 		echo json_encode($results);//muestra el resultado

		break;
        case "select":

                $rspta = $area->listar();//Carga variable con funcion select de categoría
                echo '<option value="0">seleccione...</option>';
                while ($reg = $rspta->fetch_object())//mientras exista respuesta
                        {
                                echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
                        }
        break;
	}
?>
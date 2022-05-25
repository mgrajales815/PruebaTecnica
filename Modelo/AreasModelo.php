<?php
//Incluímos inicialmente la conexión a la base de datos
require "../Conexion/Conexion.php";

Class areas
	{
		//Implementamos el super constructor 
		public function __construct()
		{

		}

		//Implementamos un método para insertar registros
		public function insertar($nombre)
		{
			$sql="INSERT INTO areas (`nombre`) VALUES ('$nombre')";
			return ejecutarConsulta($sql);//envia la sentencia a la funcion ejecutarConsulta que está en conexion.php
		}

		//Implementamos un método para editar registros
		public function editar($id, $nombre)
		{
			$sql="UPDATE areas SET `nombre`='$nombre' WHERE id='$id'";
			return ejecutarConsulta($sql);
		}

		//Implementar un método para listar los registros
		public function listar()
		{
			$sql="SELECT * FROM areas";
			return ejecutarConsulta($sql);
		}

		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($id)
		{
			$sql="SELECT * FROM areas WHERE id='$id'";
			return ejecutarConsultaSimpleFila($sql);
		}

		//Implementar un método para mostrar los datos de un registro a modificar
		public function borrar($id)
		{
			$sql="DELETE FROM areas WHERE id='$id'";
			return ejecutarConsulta($sql);
		}

	}
?>

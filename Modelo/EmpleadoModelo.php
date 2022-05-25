<?php
//Incluímos inicialmente la conexión a la base de datos
require "../Conexion/Conexion.php";

Class empleados
	{
		//Implementamos el super constructor 
		public function __construct()
		{

		}

		//Implementamos un método para insertar registros
		public function insertar($nombre, $email, $sexo, $area_id, $boletin, $descripcion)
		{
			$sql="INSERT INTO empleado (`nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES ('$nombre', '$email', '$sexo','$area_id','$boletin', '$descripcion')";
			return ejecutarConsulta($sql);//envia la sentencia a la funcion ejecutarConsulta que está en conexion.php
		}

		//Implementamos un método para editar registros
		public function editar($id, $nombre, $email, $sexo, $area_id, $boletin, $descripcion)
		{
			$sql="UPDATE empleado SET `nombre`='$nombre',`email`='$email',`sexo`='$sexo',`area_id`='$area_id',`boletin`='$boletin',`descripcion`='$descripcion' WHERE id='$id'";
			return ejecutarConsulta($sql);
		}

		//Implementar un método para listar los registros
		public function listar()
		{
			$sql="SELECT * FROM empleado";
			return ejecutarConsulta($sql);
		}

		//Implementar un método para mostrar los datos de un registro a modificar
		public function mostrar($id)
		{
			$sql="SELECT * FROM empleado WHERE id='$id'";
			return ejecutarConsultaSimpleFila($sql);
		}

		//Implementar un método para mostrar los datos de un registro a modificar
		public function borrar($id)
		{
			$sql="DELETE FROM empleado WHERE id='$id'";
			return ejecutarConsulta($sql);
		}

	}
?>

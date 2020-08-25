<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Categoria
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$codigo,$nivel,$categorys)
	{
		$sql="INSERT INTO categoria (nombre,codigo,categorys,nivel,condicion)
		VALUES ('$nombre','$codigo','$categorys','$nivel','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcategoria,$nombre,$codigo,$nivel,$categorys)
	{
		$sql="UPDATE categoria SET nombre='$nombre',codigo='$codigo',codigo='$categorys',codigo='$nivel' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcategoria)
	{
		$sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM categoria";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select

	public function selectmenor()
	{
		$sql="SELECT * FROM categoria where condicion=1 and nivel=2";
		return ejecutarConsulta($sql);		
	}

	public function nivel($nivel)
	{
		$sql="SELECT * FROM categoria where condicion=1 and nivel=$nivel";
		return ejecutarConsulta($sql);		
	}
}

?>
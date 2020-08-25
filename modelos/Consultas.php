<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Consultas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function comprasfecha($fecha_inicio,$fecha_fin)
	{
		$sql="SELECT DATE(i.fecha_hora) as fecha,u.nombre as usuario, p.nombre as proveedor,i.tipo_comprobante,i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE DATE(i.fecha_hora)>='$fecha_inicio' AND DATE(i.fecha_hora)<='$fecha_fin'";
		return ejecutarConsulta($sql);		
	}

	public function reporte()
	{
		$sql="SELECT * from(Select c.codigo,c.nombre as Descripcion,nivel1.stock
							from categoria c
							left join articulo a
							on c.idcategoria=a.idarticulo
							LEFT JOIN(Select a.idcategoria,sum(a.stock)as stock
							from articulo a
							group by a.idcategoria)as nivel1
							on nivel1.idcategoria=c.idcategoria
							where nivel=2

							 
							 union all

							Select c.codigo,c.nombre,sum(nivel1.stock)as stock
							from categoria c
							left join 
							(Select c.categorys,c.codigo,c.nombre as Descripcion,sum(nivel2.stock)as stock
							from categoria c
							LEFT JOIN articulo a
							on c.idcategoria=a.idarticulo
							LEFT JOIN(Select a.idcategoria,sum(a.stock)as stock
							from articulo a
							group by a.idcategoria)as nivel2
							on nivel2.idcategoria=c.idcategoria
							where nivel=2
							group by c.categorys)as nivel1
							on nivel1.categorys=c.idcategoria
							where c.nivel=1
							group by nivel1.categorys

							union all

							Select c.codigo,c.nombre,sum(nivel0.stock)as stock
							from categoria c
							left join 
							(Select c.categorys,c.codigo,c.nombre,sum(nivel1.stock)as stock
							from categoria c
							left join 
							(Select c.categorys,c.codigo,c.nombre as Descripcion,sum(nivel2.stock)as stock
							from categoria c
							LEFT JOIN articulo a
							on c.idcategoria=a.idarticulo
							LEFT JOIN(Select a.idcategoria,sum(a.stock)as stock
							from articulo a
							group by a.idcategoria)as nivel2
							on nivel2.idcategoria=c.idcategoria
							where nivel=2
							group by c.categorys)as nivel1
							on nivel1.categorys=c.idcategoria
							where c.nivel=1
							group by c.categorys)as nivel0
							on nivel0.categorys=c.idcategoria
							where nivel=0
							GROUP BY c.categorys

							union all

							Select codigo,nombre,stock
							from articulo
							)
							as tabla
							order by codigo
							";
		return ejecutarConsulta($sql);		
	}

	public function totalcomprahoy()
	{
		$sql="SELECT IFNULL(SUM(total_compra),0) as total_compra FROM ingreso WHERE DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function totalventahoy()
	{
		$sql="SELECT IFNULL(SUM(total_venta),0) as total_venta FROM venta WHERE DATE(fecha_hora)=curdate()";
		return ejecutarConsulta($sql);
	}

	public function comprasultimos_10dias()
	{
		$sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}

	public function ventasultimos_12meses()
	{
		$sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(total_venta) as total FROM venta GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,10";
		return ejecutarConsulta($sql);
	}
}

?>
<?php
class ProductosMasVendidosModel extends Query{
    private $cedula,$nombre,$telefono,$direccion,$id,$estado;
    public function __construct()
    {
       parent :: __construct();
    }


public function getProductosMasVendidos()
{
    $sql= "SELECT d.id_producto,d.cantidad, p.id, p.descripcion,sum(d.cantidad)as total from detalle_compras d inner join productos p on p.id = d.id_producto group by d.id_producto order by d.cantidad desc limit 2";
        $data = $this->selectAll($sql);
        return $data;
}


}

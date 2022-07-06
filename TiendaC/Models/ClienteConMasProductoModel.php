<?php
class ClienteConMasProductoModel extends Query{
    private $cedula,$nombre,$telefono,$direccion,$id,$estado;
    public function __construct()
    {
       parent :: __construct();
    }


    public function ClienteConMasProducto()
    {
     $sql= "SELECT cl.id, cl.nombre,sum(d.cantidad) as total
        from compras c 
        INNER join clientes cl on cl.id = c.id_cliente
        INNER JOIN detalle_compras d on d.id_compra = c.id
        GROUP by cl.id ORDER by total desc limit 2";
        $data = $this->selectAll($sql);
        return $data;

    }

}
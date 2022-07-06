<?php
class VentasModel extends Query{



    public function __construct()
    {
       parent :: __construct();
    }

    public function getclientes()
    {
        $sql = "SELECT * FROM clientes WHERE estado =1 ";
        $data= $this->selectAll($sql);
        return $data;
    }

//     public function registarVenta(int $id_cliente,string $total)
//    {
//     $sql = "INSERT INTO ventas (id_cliente,total) VALUES (?,?)";
//     $datos = array($id_cliente,$total);
//     $data=$this->save($sql,$datos);
//     if($data==1){
//         $res = "ok";
//     }else {
//         $res = "error";
//     }
//     return $res;
//    }




}



?>
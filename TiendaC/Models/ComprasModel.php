<?php
class ComprasModel extends Query{
    private $codigo,$nombre,$precio_compra,$precio_venta,$id;
    public function __construct()
    {
       parent :: __construct();
    }

    public function getProductoCodigo(string $codigo)
    {
        $sql = "SELECT * FROM productos WHERE codigo ='$codigo' ";
        $data= $this->select($sql);
        return $data;
    }
  

    public function getProductos(int $id)
    {
        $sql = "SELECT * FROM productos WHERE id =$id ";
        $data= $this->select($sql);
        return $data;
    }

    public function getProductusUddate(int $id)
    {
        $sql = "UPDATE * FROM productos WHERE id =$id ";
        $data= $this->select($sql);
        return $data;
    }
    public function registrardetalle(string $table, int $id_producto,int $id_usuario,string $precio,int $cantidad,string $sub_total)
    {
        $sql = "INSERT INTO $table(id_producto,id_usuario,precio,cantidad,sub_total) VALUES (?,?,?,?,?) ";
        $datos = array($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
        $data=$this->save( $sql,$datos);
        if($data==1){
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
    }

   public function getDetalle(string $table,int $id)
   {
        $sql = "SELECT d.*,p.id as id_pro , p.descripcion FROM $table d INNER JOIN  productos p ON d.id_producto=p.id where d.id_usuario = $id ";
        $data = $this->selectAll($sql);
        return $data;
   }

   public function calcularcompra(string $table,int $id_usuario)
   {
    $sql = "SELECT sub_total, SUM(sub_total) AS  total FROM $table where id_usuario =$id_usuario ";
    $data = $this->select($sql);
    return $data;
   }

   public function deleteDetalle(string $table,int $id)
   {
    $sql = "DELETE FROM $table  where id = ? ";
    $datos = array($id);
    $data = $this->save($sql,$datos);
    if($data==1){
        $res = "ok";
    }else {
        $res = "error";
    }
    return $res;
   }
     

   public function consultardetalle(string $table, int $id_producto, int $id_usuario)
   {
    $sql = "SELECT * from $table where id_producto =  $id_producto and id_usuario =$id_usuario";
    $data = $this->select($sql);
    return $data;
   }


   public function Actualizardetalle(string $table, string $precio,int $cantidad,string $sub_total,int $id_producto,int $id_usuario)
   {
       $sql = "UPDATE $table set precio = ? , cantidad = ? , sub_total = ?  where id_producto = ? and id_usuario = ? ";
       $datos = array($precio, $cantidad,$sub_total,$id_producto, $id_usuario );
       $data=$this->save( $sql,$datos);
       if($data==1){
           $res = "modificado";
       }else {
           $res = "error";
       }
       return $res;
   }

   public function registarCompras(int $id_cliente,string $total)
   {
    $sql = "INSERT INTO compras (id_cliente,total) VALUES (?,?)";
    $datos = array($id_cliente,$total);
    $data=$this->save($sql,$datos);
    if($data==1){
        $res = "ok";
    }else {
        $res = "error";
    }
    return $res;
   }

   public function registarVenta(string $total)
   {
    $sql = "INSERT INTO ventas (total) VALUES (?)";
    $datos = array($total);
    $data=$this->save($sql,$datos);
    if($data==1){
        $res = "ok";
    }else {
        $res = "error";
    }
    return $res;
   }

   public function id_compra()
   {
     $sql = "SELECT MAX(id) as id FROM compras";
     $data=$this->select( $sql);
     return $data;
   }
   public function id_venta()
   {
     $sql = "SELECT MAX(id) as id FROM ventas";
     $data=$this->select( $sql);
     return $data;
   }

   public function registarDetalleCompras(int $id_compra,int $id_cliente,int $id_producto, int $cantidad, string $precio, string $sub_total)
   {
    $sql = "INSERT INTO detalle_compras (id_compra,id_cliente,id_producto,cantidad,precio,sub_total) VALUES (?,?,?,?,?,?)";
    $datos = array($id_compra,$id_cliente,$id_producto,$cantidad, $precio,$sub_total);
    $data=$this->save($sql,$datos);
    if($data==1){
        $res = "ok";
    }else {
        $res = "error";
    }
    return $res;
   }

   public function registarDetalleVenta(int $id_venta,int $id_producto, int $cantidad, string $precio, string $sub_total)
   {
    $sql = "INSERT INTO detall (id_venta,id_producto,cantidad,precio,sub_total) VALUES (?,?,?,?,?)";
    $datos = array($id_venta,$id_compra,$id_producto,$cantidad, $precio,$sub_total);
    $data=$this->save($sql,$datos);
    if($data==1){
        $res = "ok";
    }else {
        $res = "error";
    }
    return $res;
   }
   public function ActualizarStock( int $cantidad,int $id_producto)
   {
        $sql = "UPDATE productos set cantidad = ?  WHERE id = ?";
        $datos = array($cantidad,$id_producto);
        $data=$this->save($sql,$datos);
       
        return $data;
   }

   ///////funciones de las ventas en el controlador

   public function getventasCodigo(string $codigo)
   {
       $sql = "SELECT * FROM productos WHERE codigo ='$codigo' ";
       $data= $this->select($sql);
       return $data;
   }


   public function getclientes()
   {
       $sql = "SELECT * FROM clientes WHERE estado =1 ";
       $data= $this->selectAll($sql);
       return $data;
   }
   public function getclientesVentas(int $id)
   {
       $sql = "SELECT c.id, c.id_cliente, cl.* FROM compras c inner join clientes cl on cl.id= c.id_cliente where c.id =$id ";
       $data= $this->select($sql);
       return $data;
   }

   public function vaciarDetalle(int $id_usuario)
   {
        $sql = "DELETE FROM detalle  WHERE id_usuario = ?";
        $datos = array($id_usuario);
        $data=$this->save($sql,$datos);
        if($data==1){
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
   }

   public function getProductosVenta(int $id_venta)
   {
        $sql = "SELECT c.*, d.*, p.id, p.descripcion FROM compras c INNER JOIN detalle_compras d ON c.id = d.id_compra inner join productos  p on p.id = d.id_producto where c.id = $id_venta";
        $sql_ = "SELECT * FROM clientes where id =  $id_venta ";
        $data = $this->selectAll($sql, $sql_);
        return $data;
  
    }

    public function getclienteVenta(int $id)
    {
        $sql = "SELECT * FROM clientes WHERE id  = $id ";
        $data= $this->select($sql);
        return $data;
    }

    public function getProVenta(int $id_venta)
    {
         $sql = "SELECT c.*, d.*, p.id, p.descripcion FROM ventas c INNER JOIN detalle_compras d ON c.id = d.id_compra inner join productos  p on p.id = d.id_producto where c.id = $id_venta";
         $data = $this->selectAll($sql);
         return $data;
   
     }


    public function gethistorialVentas()
    {
      $sql = "SELECT * FROM compras";
      $data=$this->selectAll($sql);
      return $data;
    }

    public function getDatos(string $table)
    {
     $sql= "SELECT COUNT(*) as total  FROM $table ";
     $data = $this->select($sql);
     return $data;
    }


    public function stockMinimo()
    {
        $sql= "SELECT* FROM productos where cantidad < 15 order by cantidad desc limit 10 ";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function productosmasvendidos()
    {
        $sql= "SELECT d.id_producto,d.cantidad, p.id, p.descripcion,sum(d.cantidad)as total from detalle_compras d inner join productos p on p.id = d.id_producto group by d.id_producto order by d.cantidad desc limit 2";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function getAnularCompra(int $id_compra)
    {
      $sql = "SELECT c.*, d.* FROM compras c inner join detalle_compras d on c.id = d.id_compra where c.id =$id_compra" ;
      $data = $this->selectAll($sql);
      return $data;
    }


    public function getanularcompras(int $id_compra)
    {
        $sql = "SELECT c.*, d.* FROM ventas c INNER JOIN detalle_compras d ON c.id = d.id_compra  where c.id = $id_compra";
         $data = $this->selectAll($sql);
         return $data;
    }

    public function getAnular(int $id_compra)
    {
        $sql = "UPDATE compras set estado = ? where id = ?";
        $datos = array(0,$id_compra);
        $data = $this->save($sql,$datos);
        if($datos==1){
            $res = "ok";
        }else {
            $res = "error";
        }
        return $res;
        
    }







 




}

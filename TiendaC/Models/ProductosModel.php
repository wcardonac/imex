<?php
class ProductosModel extends Query{
    private $codigo,$nombre,$precio_venta,$cantidad,$id;
    public function __construct()
    {
       parent :: __construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT * FROM productos WHERE usuario = '$usuario' AND clave = '$clave'";
        $data = $this->select($sql);
        return $data;
    }
    public function getCajas()
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT * FROM caja WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT * FROM productos ";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function RegistrarProducto(string $codigo, string $nombre,string $precio_venta, string $cantidad)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio_venta = $precio_venta;
       
        $verificar = "SELECT * FROM productos where codigo='$this->codigo'";
        $existe = $this->select($verificar);
            if (empty( $existe)) {
                # code...
                //hacemos el insert a la tabla caja
                $sql = "INSERT INTO productos(codigo,descripcion,precio_venta,cantidad) VALUES (?,?,?,?)";
                //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
                $datos = array($this->codigo,$this->nombre,$this->precio_venta,$this->cantidad);
                $data= $this->save($sql,$datos);
                if($data==1){
                    $res = "ok";
                }else {
                    $res = "error";
                }
                }else {
                    $res = "existe";
            }
        return $res;
//el metodo RegistrarUsuario lo vamos a llamar en el controlador
    }
    public function ModificarProducto(string $codigo, string $nombre,string $precio,string $cantidad, int $id)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->id = $id;
        $sql = "UPDATE productos SET codigo = ?, descripcion = ? , precio_venta = ?,cantidad= ? where id = ?";
        //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
        $datos = array($this->codigo,$this->nombre,$this->precio, $this->cantidad,$this->id);
        $data= $this->save($sql,$datos);
                if($data==1){
                    $res = "modificado";
                }else {
                    $res = "error";
                }
        return $res;
          
//el metodo RegistrarUsuario lo vamos a llamar en el controlador
    }
    public function editarProducto(int $id)
    {
        //vamos ha hacer la consulta en la db para traer el id seleccionado
        $sql = "SELECT * FROM productos where id = $id ";
       
        $data =  $this->select( $sql);
        return $data;
    }

    public function eliminarProducto(int $id)
    {
        $this->id = $id;
        // $this->estado = $estado;
        $sql = "UPDATE productos set estado = 0 where id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function eliminarPro(int $id)
    {
       $this->id=$id;
       $sql = "DELETE FROM productos where id = $id";
       $datos = array($this->id);
       $data = $this->save($sql,$datos);
       return $data;

    }
    public function reingresarProducto(int $id)
    {
        $this->id = $id;
        // $this->estado = $estado;
        $sql = "UPDATE productos set estado = 1 where id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
 
}

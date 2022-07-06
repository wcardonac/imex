<?php
class UsuariosModel extends Query{
    private $usuario,$nombre,$clave,$id_caja,$id,$estado;
    public function __construct()
    {
       parent :: __construct();
    }
    public function getUsuario(string $usuario, string $clave)
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
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
    public function getUsuarios()
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT u.*, c.id as id_caja, c.caja FROM usuarios u INNER JOIN caja c where u.id_caja = c.id" ;
        $data = $this->selectAll($sql);
        return $data;
    }

    public function RegistrarUsuario(string $usuario, string $nombre,string $clave,int $id_caja)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->id_caja = $id_caja;
        $verificar = "SELECT * FROM usuarios where usuario='$this->usuario'";
        $existe = $this->select($verificar);
            if (empty( $existe)) {
                # code...
                //hacemos el insert a la tabla caja
                $sql = "INSERT INTO usuarios(usuario,nombre,clave,id_caja) VALUES (?,?,?,?)";
                //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
                $datos = array($this->usuario,$this->nombre,$this->clave,$this->id_caja);
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
    public function ModificarUsuario(string $usuario, string $nombre,int $id_caja, int $id)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $this->id_caja = $id_caja;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ? , id_caja = ? where id = ?";
        //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
        $datos = array($this->usuario,$this->nombre,$this->id_caja,$this->id);
        $data= $this->save($sql,$datos);
                if($data==1){
                    $res = "modificado";
                }else {
                    $res = "error";
                }
        return $res;
          
//el metodo RegistrarUsuario lo vamos a llamar en el controlador
    }
    public function editarusuario(int $id)
    {
        //vamos ha hacer la consulta en la db para traer el id seleccionado
        $sql = "SELECT * FROM usuarios where id = $id ";
       
        $data =  $this->select( $sql);
        return $data;
    }

    public function eliminaruser(int $id)
    {
        $this->id = $id;
        // $this->estado = $estado;
        $sql = "UPDATE usuarios set estado = 0 where id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function reingresar(int $id)
    {
        $this->id = $id;
        // $this->estado = $estado;
        $sql = "UPDATE usuarios set estado = 1 where id = ?";
        $datos = array($this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
 
}

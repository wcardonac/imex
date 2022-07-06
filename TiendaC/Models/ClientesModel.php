<?php
class ClientesModel extends Query{
    private $cedula, $nombre,$apellido,$nacimiento,$edad,$email,$ciudad,$id,$estado;
    public function __construct()
    {
       parent :: __construct();
    }


    public function getClientes()
    {
        //hacemos la consulta  a ala base de datos
        $sql = "SELECT * FROM clientes ";
        $data = $this->selectAll($sql);
        return $data;
    }
   
    public function RegistrarCliente( string $cedula,string $nombre, string $apellido,string $nacimiento,string $edad,string $email,string $ciudad)
    {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nacimiento = $nacimiento;
        $this->edad = $edad;
        $this->email = $email;
        $this->ciudad = $ciudad;
        
        $verificar = "SELECT * FROM clientes where cedula='$this->cedula'";
        $existe = $this->select($verificar);
            if (empty( $existe)) {
               
                //hacemos el insert a la tabla caja
                $sql = "INSERT INTO clientes(cedula,nombre,apellido,f_nacimiento,edad,correo,ciudad) VALUES (?,?,?,?,?,?,?)";
                //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
                $datos = array($this->cedula,$this->nombre, $this->apellido,$this->nacimiento,$this->edad,$this->email,$this->ciudad);
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
//el metodo Registrarcedula lo vamos a llamar en el controlador
    }
    public function ModificarCliente(string $cedula,string $nombre, string $apellido,string $nacimiento,string $edad,string $email,string $ciudad, int $id)
    {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->nacimiento = $nacimiento;
        $this->edad = $edad;
        $this->email = $email;
        $this->ciudad = $ciudad;
        $this->id = $id;
        $sql = "UPDATE clientes SET  cedula = ?, nombre = ?, apellido = ?, f_nacimiento= ? , edad = ?, correo = ?, ciudad = ? where id = ?";
        //estos valores los vamos a enviar a un metodo que vamos a crear en el archivo Query
        $datos = array($this->cedula,$this->nombre, $this->apellido,$this->nacimiento,$this->edad,$this->email,$this->ciudad,$this->id);
        $data= $this->save($sql,$datos);
                if($data==1){
                    $res = "modificado";
                }else {
                    $res = "error";
                }
        return $res;
          
//el metodo Registrarcedula lo vamos a llamar en el controlador
    }
    public function editarCliente(int $id)
    {
        //vamos ha hacer la consulta en la db para traer el id seleccionado
        $sql = "SELECT * FROM clientes where id = $id ";
       
        $data =  $this->select( $sql);
        return $data;
    }

    public function accioncli(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE clientes set estado = ? where id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function reingresarcedula(int $estado,int $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE cedula set estado = ? where id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function eliminarCliente(int $id)
    {
       // $this->id = $id;
        $sql = "DELETE FROM clientes WHERE id = $id";
        $datos = array($this->id);
        $data = $this->save($sql,$datos);
        return $data;

    }
}

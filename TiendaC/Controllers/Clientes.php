<?php
class Clientes extends Controller {
    
  public function __construct()
  {
    session_start();
    //hacer la ssecion privada
    if (empty($_SESSION['activo'])) {
     header("location".base_url);
    }
  parent:: __construct();

  }

  public function index()
  {
 
    $this->views->getView($this, "index");

  }

  public function listar()
  {
    $data =  $this->model->getClientes();
   
    
  
    for ($i=0; $i < count($data) ; $i++) {
      if ($data[$i]['estado']==1) {
      
        $data[$i]['acciones'] = '<div>
        <button class="btn btn-primary" type="button" onclick="editarCliente('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button"onclick="eliminarCliente('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
       
        </div>';
      } else {
        $data[$i]['estado'] = '<span class="badge badge-danger">inactivo</span>';
        $data[$i]['acciones'] = '<div>      
        <button class="btn btn-success" type="button"onclick="ReingresarCliente('.$data[$i]['id'].');">Reingreso</button>
        </div>';
      }
    }
    echo json_encode ($data, JSON_UNESCAPED_UNICODE );
  die();
  }



  public function registrar()  {
      //vamos a almacenar los valores que se le estan enviando
      $cedula = $_POST['cedula'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $nacimiento = $_POST['nacimiento'];
      $edad = $_POST['edad'];
      $correo =  filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL);
     
      //$correo = $_POST['correo'];
      $ciudad = $_POST['ciudad'];

      $id = $_POST['id'];
     
     
      if(empty($cedula)|| empty($nombre)|| empty($apellido) ||empty($nacimiento)||empty($edad)||empty($correo)||empty($ciudad)){
        $msg = "el formato del correo no es valido";
        }else {
          if ($id=="") {
               //resive 4 parametrsos
              $data = $this->model->RegistrarCliente($cedula,$nombre,$apellido,$nacimiento,$edad,$correo,$ciudad);
              if ($data== "ok") {
                $msg ="si";
              }else if($data=="existe"){
                $msg= "la cedula ya existe";
              }else {
              $msg = "error al registrar la clientes";
              }
            
       }else{
        $data = $this->model->ModificarCliente($cedula,$nombre,$apellido,$nacimiento,$edad,$correo,$ciudad,$id);
        if ($data== "modificado") {
          $msg ="modificado";
        }else {
        $msg = "error al modificar el cliente";
        }
      }
      
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function editar(int $id)
    {
      // verificamos si estamos capturando el id
     // print_r($id);
     $data = $this->model->editarCliente($id);
    //  print_r($data);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
    }
  
    public function eliminar(int $id)
    {
      $data= $this->model->accioncli(0, $id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al eliminar el usuario";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function reingresar($id)
    {
      $data= $this->model->accioncli(1,$id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al reingreso un ciente";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function eliminarCliente($id)
    {
      $data = $this->model->eliminarCliente($id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al reingreso un ciente";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }
  
  
  }





?>



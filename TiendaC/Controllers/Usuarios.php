<?php
class Usuarios extends Controller {
    
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
  // $data['cajas']= $this->model->getCajas();//
    $this->views->getView($this, "index");

  }

  // public function home()
  // {
 
  // $this->views->getView($this, "home");

  // }

  public function listar()
  {
    $data =  $this->model->getUsuarios();
    for ($i=0; $i < count($data) ; $i++) {
      if ($data[$i]['estado']==1) {
        $data[$i]['estado'] = '<span class="badge badge-success">activo</span>';
        $data[$i]['acciones'] = '<div>
        <button class="btn btn-primary" type="button" onclick="editarusuario('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button"onclick="eliminarUsuario('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
      
        </div>';
        
      } else {
        $data[$i]['estado'] = '<span class="badge badge-danger">inactivo</span>';
        $data[$i]['acciones'] = '<div>
        <button class="btn btn-success" type="button"onclick="ReingresarUsuario('.$data[$i]['id'].');">Reingreso</button>
        </div>';
      }
    }
    echo json_encode ($data, JSON_UNESCAPED_UNICODE );
  
  }

  public function validar()
  {
  if (empty($_POST['usuario']) || empty($_POST['clave']) ) {
    $msg = "los campo estan vacios";
  }else {
      $usuario = $_POST['usuario'];
      $clave = $_POST['clave'];
      $hash = hash("SHA256",  $clave);
      $data = $this->model->getUsuario($usuario,$hash);
      if ($data) {
        $_SESSION['id_usuario'] = $data['id'];
        $_SESSION['usuario'] = $data['usuario'];
        $_SESSION['nombre'] = $data['nombre'];
         $_SESSION['activo'] = true;
        $msg = "ok"; 
      }else{
        $msg = "contraseña incorrecta";
      }
  }
  echo json_encode($msg, JSON_UNESCAPED_UNICODE);
  die();
  }

  public function registrar()
 
  {
      //vamos a almacenar los valores que se le estan enviando
      $usuario = $_POST['usuario'];
      $nombre = $_POST['nombre'];
      $clave = $_POST['clave'];
      $confirmar = $_POST['confirmar'];
      $caja = $_POST['caja'];
      $id = $_POST['id'];
      //encriptar el passwo
      $hast = hash("SHA256",$clave);
      if(empty($usuario)|| empty($nombre) ||empty($caja)){
        $msg = "todos los campos son obligatoris";
        }else {
          if ($id=="") {
            if ($clave != $confirmar) {
              $msg = "Las contraseñas no coinciden";
            }else {
               //resive 4 parametrsos
              $data = $this->model->RegistrarUsuario($usuario,$nombre,$hast,$caja);
              if ($data== "ok") {
                $msg ="si";
              }else if($data=="existe"){
                $msg= "el usuario ya existe";
              }else {
              $msg = "error al registrar el usaurio";
              }
            }
       }else{
        $data = $this->model->ModificarUsuario($usuario,$nombre,$caja,$id);
        if ($data== "modificado") {
          $msg ="modificado";
        }else {
        $msg = "error al modificar el usaurio";
        }
      }
      
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function editar(int $id)
    {
      //verificamos si estamos capturando el id
      // print_r($id);
     $data = $this->model->editarusuario($id);
    //  print_r($data);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
    }
  
    public function eliminar(int $id)
    {
     
      $data= $this->model->eliminaruser($id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al eliminar un usuario";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function reingresar(int $id)
    {
      $data= $this->model->reingresar($id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al reingreso un usuario";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function salir()
    {
      session_destroy();
      header("location:".base_url);
    }



  
  
  
  
  
  
  
 
 
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  }





?>



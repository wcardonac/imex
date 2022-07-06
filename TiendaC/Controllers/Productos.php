<?php
class Productos extends Controller {
    
  public function __construct()
  {
    session_start();
    //hacer la  privada
    if (empty($_SESSION['activo'])) {
     header("location".base_url);
    }
  parent:: __construct();

  }

  public function index()
  {
   // $data['cajas']= $this->model->getCajas();
    $this->views->getView($this, "index");

  }

  public function listar()
  {
    $data =  $this->model->getProductos();
    for ($i=0; $i < count($data) ; $i++) {
      if ($data[$i]['estado']==1) {
        $data[$i]['estado'] = '<span class="badge badge-success">activo</span>';
        $data[$i]['acciones'] = '<div>
        <button class="btn btn-primary" type="button" onclick="editarProducto('.$data[$i]['id'].');"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" type="button"onclick="eliminarProducto('.$data[$i]['id'].');"><i class="fas fa-trash-alt"></i></button>
      
        </div>';
        
      } else {
        $data[$i]['estado'] = '<span class="badge badge-danger">inactivo</span>';
        $data[$i]['acciones'] = '<div>
        <button class="btn btn-success" type="button"onclick="ReingresarProducto('.$data[$i]['id'].');">Reingreso</button>
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
      $codigo = $_POST['codigo'];
      $nombre = $_POST['nombre'];
      $precio = $_POST['precio'];
      $cantidad = $_POST['cantidad'];
      // $precio_venta = $_POST['precio_venta'];
      $id = $_POST['id'];
      //encriptar el passwo
     
      if(empty($codigo)|| empty($nombre) ||empty($precio)){
        $msg = "todos los campos son obligatorios";
        }else {
          if ($id=="") {
           
               //resive 4 parametrsos
              $data = $this->model->RegistrarProducto($codigo,$nombre,$precio,$cantidad);
              if ($data== "ok") {
                $msg ="si";
              }else if($data=="existe"){
                $msg= "El producto ya existe";
              }else {
              $msg = "error al registrar el usaurio";
              }
            
       }else{
        $data = $this->model->ModificarProducto($codigo,$nombre,$precio,$cantidad,$id);
        if ($data== "modificado") {
          $msg ="modificado";
        }else if($data=="existe"){
          $msg= "El producto ya existe";
        }else {
        $msg = "error al modificar el usuario";
        }
      }
      
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function editar(int $id)
    {
      //verificamos si estamos capturando el id
    
     $data = $this->model->editarProducto($id);
    
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
    }
  
    public function eliminar(int $id)
    {
     
      $data= $this->model->eliminarProducto($id);
      if ($data == 1) {
        $msg = "ok";
      }else {
      $msg = "error al eliminar un usuario";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function eliminarPro($id)
    {
      $data= $this->model->eliminarPro($id);
      if ($data ==1) {
        $msg = "ok";
      } else {
        $mag = "erroe al elimiar un producto";
      }
      echo json_encode($msg, JSON_UNESCAPED_UNICODE);
      die();
    }

    public function reingresar(int $id)
    {
      $data= $this->model->reingresarProducto($id);
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



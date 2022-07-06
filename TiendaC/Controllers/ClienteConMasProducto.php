
<?php

class ClienteConMasProducto extends Controller {
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

      public function listarClienteConMas()
      {
       $data= $this->model->ClienteConMasProducto();
       for ($i=0; $i < count($data) ; $i++) {
        $data[$i]['acciones'] = '<div>
       
          </div>';
      }
       echo json_encode ($data, JSON_UNESCAPED_UNICODE );
       die();
      }

}





?>




<?php

class ProductosMasVendidos extends Controller {
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
        // $data['cajas']= $this->model->getCajas();
        $this->views->getView($this, "index");
    
      }

      public function listarProMas()
      {
       $data= $this->model->getProductosMasVendidos();
       for ($i=0; $i < count($data) ; $i++) {
        $data[$i]['acciones'] = '<div>
       
         
          </div>';
      }
       echo json_encode ($data, JSON_UNESCAPED_UNICODE );
       die();
      }

}





?>



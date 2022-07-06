
<?php
class HistorialVentas extends Controller{

    public function  __construct()
        {
        session_start();
        parent::__construct();
        }
    
          public function index( )
          {
            
              $this->views->getView($this, "index");
          }


    public function HistoriaVentas()
    {
        $this->views->getView($this, "HistoriaVentas");
    }

}



?>
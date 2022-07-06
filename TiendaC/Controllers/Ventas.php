<?php
class Ventas extends Controller 
{
    public function  __construct()
    {
    session_start();
    parent::__construct();
    }

    public function index()
    {
        //hacemos una consulta ala db
          $data = $this->model->getclientes();
          $this->views->getView($this, "index", $data);
    }


   
  
}







?>
<?php
class Compras extends Controller 
{
    public function  __construct()
    {
    session_start();
    parent::__construct();
    }

      public function index( $data)
      {
          $data = $this->model->getclientes();
          $this->views->getView($this, "index", $data);
      }
      public function ventas()
      {
          $this->views->getView($this, "ventas");
      }

      public function buscarCodigo($codigo)
      {
        $data = $this->model->getProductoCodigo($codigo);
        echo json_encode ($data, JSON_UNESCAPED_UNICODE );
        die();
      }
  

      public function ingresarcopia()
      {
        
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $sub_total = $precio * $cantidad;
        // //$comprobar = $this->model->consultardetalle($id_producto,$id_usuario);
        $data = $this->model->registrardetalle($id_producto,$id_usuario,$precio,$cantidad,$sub_total);
        if ( $data =="ok") {
          $msg="ok";
        }else {
          $msg="error";
        }

          echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
          die();
      }
      public function ingresar()
      {
        
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultardetalle('detalle',$id_producto,$id_usuario);
        if (empty( $comprobar)) {
          if ( $datos['cantidad'] >=  $cantidad)  {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrardetalle('detalle',$id_producto,$id_usuario,$precio,$cantidad,$sub_total);
            if ( $data =="ok") {
              $msg="ok";
            }else {
              $msg="error";
            }
          }else{
            $msg= array('msg'=>' cantidad en stock no es suficiente para la compra', 'icono'=>'warring');
           
          }
         
        }else{
          $total_cantidad = $comprobar['cantidad'] + $cantidad;
          $sub_total = $total_cantidad*$precio;
          if ($datos['cantidad']<  $total_cantidad) {
            $msg="el stock no esta disponible para la venta";
          }else {
            $data = $this->model->Actualizardetalle('detalle',$precio,$total_cantidad,$sub_total,$id_producto,$id_usuario);
            if ( $data =="modificado") {
              $msg="modificado";
            }else {
              $msg="error al midificar el produ";
            }
          }
        }

          echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
          die();
      }


      public function listar($table)
      {
        $id_usuario = $_SESSION['id_usuario'];
        $data['detalle'] = $this->model->getDetalle($table,$id_usuario);

        $data['sub_total'] = $this->model->calcularcompra($table,$id_usuario);
        echo json_encode ($data, JSON_UNESCAPED_UNICODE );
        die();
      }

      public function delete($id)
      {
        $data = $this->model->deleteDetalle('detalle',$id);
        if ( $data == "ok") {
          $msg = "ok";
        }else {
          $msg ="error al eliminar el priducto";
        }
        echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
        die();
      }

      public function registarCompra($id_cliente)
      {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularcompra('detalle',$id_usuario);
        $data =$this->model->registarCompras($id_cliente,$total['total']);
       if ($data=="ok") {
        $detalle = $this->model->getDetalle('detalle',$id_usuario);
        $id_compra=$this->model->id_compra();
       foreach($detalle as $row){
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];
        $id_producto= $row['id_producto'];
        $sub_total =  $cantidad* $precio;
        $this->model->registarDetalleCompras($id_compra['id'],$id_cliente,$id_producto,$cantidad,$precio,$sub_total);
        $stock_actual=$this->model->getProductos($id_producto);
        $stock = $stock_actual['cantidad']-$cantidad;
        $this->model->ActualizarStock($stock,$id_producto);
       }
        $vaciar= $this->model->vaciarDetalle($id_usuario);
        if ($vaciar=="ok") {
          
          $msg = array('msg'=>'ok','id_compra'=>$id_compra['id']);
        }
        }else {
          $msg= "Error al realizar";
        }
        echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
        die();

        
      }

      

      public function registarVenta($id_cliente)
      {
        $id_usuario = $_SESSION['id_usuario'];
        $total = $this->model->calcularcompra('detalle_temporal',$id_usuario);
        $data =$this->model->registarVenta($id_cliente,$total['total']);
       if ($data=="ok") {
        $detalle = $this->model->getDetalle('detalle_temporal',$id_usuario);
        $id_venta=$this->model->id_venta();
       foreach($detalle as $row){
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];
        $id_producto= $row['id_producto'];
        $sub_total =  $cantidad* $precio;
        $this->model->registarDetalleVenta($id_venta['id'],$id_producto,$cantidad,$precio,$sub_total);
        $stock_actual=$this->model->getProductos($id_producto);
        $stock = $stock_actual['cantidad']-$cantidad;
        $this->model->ActualizarStock($stock,$id_producto);
       }
          $msg = "ok";
       }else {
        $msg= "Error al realizar";
       }
       echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
       die();
      }




      /////funciones para comtrolador de las ventas

      public function buscarCodigoVenta($codigo)
      {
        $data = $this->model->getventasCodigo($codigo);
        echo json_encode ($data, JSON_UNESCAPED_UNICODE );
        die();
      }

      public function ingresarVenta()
      {
        
        $id = $_POST['id'];
        $datos = $this->model->getProductos($id);
        $id_producto = $datos['id'];
        $id_usuario = $_SESSION['id_usuario'];
        $precio = $datos['precio_venta'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultardetalle('detalle_temporal',$id_producto,$id_usuario);
        if (empty( $comprobar)) {
          $sub_total = $precio * $cantidad;
          $data = $this->model->registrardetalle('detalle_temporal',$id_producto,$id_usuario,$precio,$cantidad,$sub_total);
          if ( $data =="ok") {
            $msg="ok";
          }else {
            $msg="error";
          }
         
        }else{
          $total_cantidad = $comprobar['cantidad'] + $cantidad;
          $sub_total = $total_cantidad*$precio;
          $data = $this->model->Actualizardetalle('detalle_temporal',$precio,$total_cantidad,$sub_total,$id_producto,$id_usuario);
          if ( $data =="modificado") {
            $msg="modificado";
          }else {
            $msg="error al midificar el produ";
          }
        }

          echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
          die();
      }

      public function deleteventa($id)
      {
        $data = $this->model->deleteDetalle('detalle_temporal',$id);
        if ( $data == "ok") {
          $msg = "ok";
        }else {
          $msg ="error al eliminar el priducto";
        }
        echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
        die();
      }




      public function generarPdf($id_venta)
      {
        $productos_ventas= $this->model->getProductosVenta($id_venta);
        // print_r( $productos_ventas);
        // exit;
        $clientes = $this->model->getclientesVentas($id_venta);
        //  print_r($clientes);
        //  exit;
       
        
        require('Librerias/fpdf/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(5,0,0);
        $pdf->SetTitle('reporte de venta');
        $pdf->SetFont('Arial','B',9);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(65,10, utf8_decode('Taller php imex'),0,2,'L');
        $pdf->Ln();
     //encabezado de los clientes
        $pdf->Cell(25, 5,'Factura numero:', 0 ,0, 'L');
        $pdf->Cell(20, 5,$id_venta, 0 ,1, 'L');
        $pdf->Ln();
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(25,5, 'cedula:',0,0,'L',true);
        $pdf->Cell(25,5, 'Nombre:',0 , 0, 'L',true);
        $pdf->Cell(25,5, 'Apellido:',0 , 0, 'L',true);
        $pdf->Cell(40,5, 'correo:',0,1,'L',true);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(25,5, $clientes['cedula'],0 , 0, 'L');
        $pdf->Cell(25,5, $clientes['nombre'],0 , 0, 'L');
        $pdf->Cell(25,5,  $clientes['apellido'],0,0,'L');
        $pdf->Cell(25,5,  $clientes['correo'],0,1,'L');
        $pdf->Ln();
        //encabezado de los productos
        $pdf->Ln();
        $pdf->SetFillColor(0,0,0);
        $pdf->SetTextColor(255,255,255);
        $pdf->Cell(20,5, 'cantidad:',0 , 0, 'L',true);
        $pdf->Cell(30,5, 'Descripcion:',0,0,'L',true);
        $pdf->Cell(15,5, 'precio:',0,0,'L',true);
        $pdf->Cell(20,5, 'Sub_total:',0,1,'L',true);
        $pdf->SetTextColor(0,0,0);
        $total =0.00;
        foreach ( $productos_ventas as $row) {
          $total = $total + $row['sub_total'];
          $pdf->Cell(20,5, $row['cantidad'],0 , 0, 'L');
          $pdf->Cell(30,5,  $row['descripcion'],0,0,'L');
          $pdf->Cell(15,5, number_format( $row['precio'],2,'.','.') ,0,0,'L');
          $pdf->Cell(10,5,  number_format( $row['sub_total'],2,'.','.') ,2,1,'L');
        }
        $pdf->Ln();
        $pdf->Cell(60,5, 'Total a pagar : ',4 , 0, 'R');
        $pdf->Cell(20,5, number_format($total,2,'.','.'),4 , 0, 'R');
        $pdf->Output();
        ob_end_flush();

     

      }

      /////Repprtes
      public function reportes()
      {
        $data['productos'] = $this->model->getDatos('productos');
        $data['clientes'] = $this->model->getDatos('clientes');
        $data['detalle_compras'] = $this->model->getDatos('detalle_compras');
        $this->views->getView($this, "reportes", $data);
      }
      ///funcines de las ventas


      public function historial()
      {
       // $data['id_cliente'] = $this->model->getDatos('id_cliente');
        $data['productos'] = $this->model->getDatos('productos');
        $data['clientes'] = $this->model->getDatos('clientes');
        $data['compras'] = $this->model->getDatos('compras');
        $this->views->getView($this, "historial" ,$data);
      }

      public function reporteStock()
      {
        $data = $this->model->stockMinimo();
        echo json_encode ($data, JSON_UNESCAPED_UNICODE );
        die();
      }
      public function productosmasvendidos()
      {
        $data = $this->model->productosmasvendidos();
        echo json_encode ($data, JSON_UNESCAPED_UNICODE );
        die();
      }

      public function listar_historial()
      {
       $data= $this->model->gethistorialVentas();
       for ($i=0; $i < count($data) ; $i++) {
        if ($data[$i]['estado']==1) {
          $data[$i]['estado'] = '<span class="badge badge-success">Completado</span>';
          $data[$i]['acciones'] = '<div>
          <button class="btn btn-warning" type="button" onclick="AnularCompra('.$data[$i]['id'].');"><i class="fas fa-ban"></i></button>
            <a class="btn btn-danger" href="'.base_url. "Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
            </div>';
        } else {
          $data[$i]['estado'] = '<span class="badge badge-danger">Anulado</span>';
          $data[$i]['acciones'] = '<div>
          
            <a class="btn btn-danger" href="'.base_url. "Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
            </div>';
        }



       
      }
       echo json_encode ($data, JSON_UNESCAPED_UNICODE );
       die();
      }


      public function AnularCompra($id_compra)
      {
       $data= $this->model->getProductosVenta($id_compra);
      $anular= $this->model->getAnular($id_compra);
      foreach ($data as $row) {
      
        $stock_actual=$this->model->getProductos($row['id_producto']);
        $stock = $stock_actual['cantidad']+$row['cantidad'];
       
        $this->model->ActualizarStock($stock, $row['id_producto']);
      }
      if ($anular == "ok") {
        $msg = "ok";
      }else {
        $msg ="Venta Anulada";
      }
      echo json_encode ($msg, JSON_UNESCAPED_UNICODE );
      die();



      }

     

      
  
    }










?>
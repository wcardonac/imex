<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva Venta</li>
</ol>
<div class="card">
    <div class="card-body">
       <form id="frmCompra" >
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codigo">Codigo Producto </label>
                    <input type="hidden" id="id" name="id">
                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Codigo del producto" onkeyup="buscarCodigo(event);" >
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="nombre">Descripcion del</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion del producto" disabled>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad" class="form-control" type="number" name="cantidad"  onkeyup="calcularPrecio(event);" >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input id="precio" class="form-control" type="number" name="precio"  placeholder="precio de la compra"  disabled>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sub_total">sub-total</label>
                    <input id="sub_total" class="form-control" type="number" name="sub_total"  placeholder="sub-total"  disabled>
                </div>
            </div>
         
        </div>
       </form>
    </div>
</div>
<table class="table table-light">
    <thead class="thead-dark">
        <tr>
            <th>id</th>
          
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tbldetalle">
     
    </tbody>
</table>
<div class="row">
    <div class="col-md-5" >
            
        <div>
                
            <div class="form-group">
                    <label for="cliente">Seleccionar cliente</label>
                    <select id="cliente" class="form-control" name="cliente">
                          <?php foreach($data as $row){?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['cedula'] ?></option>
                         <?php } ?>
                    </select>
            </div>
              
                <div class="form-group">
               
                    <label for="telefono">Nombre</label>
                    <input id="telefono"  class="form-control" type="text" name="telefono" placeholder="Telefono" disabled>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion Cliente</label>
                    <input id="direccion"  class="form-control" type="text" name="direccion" placeholder="Direccion" disabled>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion Cliente</label>
                    <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion" disabled>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion Cliente</label>
                    <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion" disabled>
                </div>
        </div>
        <!-- <div class="col-md-4 ml-auto">
                <div class="form-group">
                    <label for="cliente">Seleccionar cliente</label>
                    <select id="cliente" class="form-control" name="cliente">
                          <?php foreach($data as $row){?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                         <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="total" class="font-weight-bold">Total</label>
                    <input id="total" class="form-control" type="number" name="total"  placeholder="total"  disabled>
                    <button class="btn btn-primary mt-2 btn-block " type="button" onclick="procesar(0);">Generar venta</button>
                </div>
        </div> -->
    </div>
    <div class="col-md-4 ml-auto">
       
            <div class="form-group">
                <label for="total" class="font-weight-bold">Total</label>
                <input id="total" class="form-control" type="number" name="total"  placeholder="total"  disabled>
                <button class="btn btn-primary mt-2 btn-block " type="button" onclick="procesar(1);">Generar Venta</button>
            </div>
       
            <div class="col-md-4 ml-auto">
        
          
     </div>
   
    </div>
</div>

<?php include "Views/Templates/footer.php"?>
<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva venta</li>
</ol>
<div class="card">
    <div class="card-body">
       <form id="frmVenta" >
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="codigo">codigo de barras</label>
                    <input type="hidden" id="id" name="id">
                    <input id="codigo" class="form-control" type="text" name="codigo" placeholder="codigo de barras" onkeyup="buscarCodigoVenta(event);" >
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="nombre">Descripcion del producto</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Descripcion del producto" disabled>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad" class="form-control" type="number" name="cantidad"  onkeyup="calcularPrecioVenta(event);" >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input id="precio" class="form-control" type="number" name="precio"  placeholder="precio venta"  disabled>
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
    <tbody id="tbldetalleVenta">
     
    </tbody>
</table>

<div class="row">
        
        <div class="col-md-3">
            
            <div class="form-group">
                <label for="cliente">Buscar Cliente</label>
                <input id="cliente" class="form-control" type="text" name="cliente" placeholder="nombre">
                <input type="hidden" id="id" name="id">
            </div>
            <div class="form-group">
                <label for="telefono">Telefono Cliente</label>
                <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono" disabled>
            </div>
            <div class="form-group">
                <label for="direccion">Direccion Cliente</label>
                <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion" disabled>
            </div>
        </div>
    <div class="col-md-4 ml-auto">
            <div class="form-group">
                <label for="">Seleccionar</label>
                <select id="" class="form-control" name="clientes">
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
    </div>
</div>



<?php include "Views/Templates/footer.php"?>
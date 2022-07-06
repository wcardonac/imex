<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Productos</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmProducto();"><i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblProducto">
    <thead class="thead-dark">
        <tr>
            <th>id</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>precio_venta</th>
            <th>Stock</th>
           
            <th></th>
        </tr>
    </thead>
    <tbody>
      
    </tbody>
</table>

<div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Productos</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" id="frmProducto">
                   <div class="form-group">        
                       <label for="codigo">codigo del producto</label>
                       <input type="hidden" id="id" name="id">
                      
                       <input id="codigo" class="form-control" type="number" name="codigo" placeholder="Codigo del producto">
                   </div>
                   <div class="form-group">
                       <label for="nombre">descripcion</label>
                       <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
                   </div>
                  <!-- <div class="form-group">
                      <label for="precio">Precio compra</label>
                      <input id="precio" class="form-control" type="number" name="precio" placeholder="precio de la compra">
                  </div> -->
                  <div class="form-group">
                      <label for="precio">Precio venta</label>
                      <input id="precio" class="form-control" type="number" name="precio" placeholder="Precio venta" require>
                  </div>

                    <div class="form-group">
                      <label for="cantidad">Cantidad</label>
                      <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="catidad">
                  </div>
                
                   <button class="btn btn-primary" type="button" id="registar" onclick="RegistrarProducto(event);">Registrar</button>
                   <button class="btn btn-danger" type="button" data-dismiss="modal" >cancelar</button>
               </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include "Views/Templates/footer.php"?>
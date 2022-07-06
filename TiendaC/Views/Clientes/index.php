<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Clientes</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmCliente();"><i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblclientes">
    <thead class="thead-dark">
        <tr>
            <th>id</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>fecha de nacimiento</th>
            <th>Edad</th>
            <th>correo</th>
            <th>ciudad</th>
            <th></th>
            
           
       
        </tr>
    </thead>
    <tbody>
      
    </tbody>
</table>

<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" id="frmCliente">
               <div class="form-group">        
                       <label for="cedula">cedula</label>
                       <input type="hidden" id="id" name="id">
                       <input id="cedula" class="form-control" type="number" name="cedula" placeholder="Cedula">
                   </div>
                   <div >        
                       <label for="nombre">Nombre</label>
                       <!-- <input type="hidden" id="id" name="id"> -->
                       <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                   </div>
                  
                   <div >
                       <label for="apellido">Apellido</label>
                       <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Apellido">
                   </div>
                   <div >
                       <label for="nacimiento">Fecha de naciento</label>
                       <input id="nacimiento" class="form-control" type="date" max="<?php echo date("Y-m-d");?>" name="nacimiento" placeholder="DD/MM/AA">
                   </div>
                  
                  <div >
                      <label for="edad">Edad</label>
                      <input id="edad" class="form-control"  type="number" name="edad" rows="3" placeholder="edad"></input>
                  </div>
                 
                  <div >
                      <label for="correo">correo</label>
                      <input id="correo" type="email"
                          class="form-control" name="correo" rows="3"></input>
                  </div> 
                   <div >
                      <label for="ciudad">ciudad</label>
                      <input id="ciudad" class="form-control" type="text"  name="ciudad" rows="3"></input>
                  </div>
                   <button class="btn btn-primary" type="button" id="registar" onclick="RegistrarCliente(event);">Registrar</button>
                   <button class="btn btn-danger" type="button" data-dismiss="modal" >cancelar</button>
               </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "Views/Templates/footer.php"?>
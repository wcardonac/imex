<?php include "Views/Templates/header.php"?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuario</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmusuarios();"><i class="fas fa-plus"></i></button>

<table class="table table-light" id="tblusuarios">
    <thead class="thead-dark">
        <tr>
            <th>id</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Caja</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      
    </tbody>
</table>

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo usaurio</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form method="post" id="frmusuario">
                   <div class="form-group">        
                       <label for="usuario">Usuario</label>
                       <input type="hidden" id="id" name="id">
                       <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                   </div>
                   <div class="form-group">
                       <label for="nombre">Nombre</label>
                       <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Usuario">
                   </div>
                   <div class="form-group" id="claves">
                       <label for="clave">Contraseña</label>
                       <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                   </div>
                   <div class="form-group" id="clav">
                       <label for="confirmar">Confirmar contraseña</label>
                       <input id="confirmar" class="form-control" type="password" name="confirmar" placeholder="Comfirmar contraseña">
                   </div>
                   <!-- <div class="form-group">
                       <label for="caja">Caja</label>
                       <select id="caja" class="form-control" name="caja">
                       <?php foreach($data['cajas'] as $row) {?>
                           <option value="<?php echo $row['id']?>"><?php echo $row['caja']?></option>
                           <?php }?>
                       </select>
                   </div> -->
                   <button class="btn btn-primary" type="button" id="registar" onclick="Registraruser(event);">Registrar</button>
                   <button class="btn btn-danger" type="button" data-dismiss="modal" >cancelarhgfhfhgfh</button>
               </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include "Views/Templates/footer.php"?>
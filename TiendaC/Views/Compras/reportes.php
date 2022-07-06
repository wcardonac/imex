<?php include "Views/Templates/header.php"?>
<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
              
                <p class="card-text"> Productos</p>
            </div>
            <div class="card-footer">
               <a href="<?php echo base_url?>Productos"> Ver detalle</a>
               <span><?php echo $data['productos']['total']?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
              
                <p class="card-text"> clientes con mas productos comprados</p>
            </div>
            <div class="card-footer">
               <a href="<?php echo base_url?>ClienteConMasProducto"> Ver detalle</a>
               <span><?php echo $data['clientes']['total']?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
              
                <p class="card-text"> Productos mas vendidos</p>
            </div>
            <div class="card-footer">
               <a href="<?php echo base_url?>ProductosMasVendidos"> Ver detalle</a>
               <span><?php echo $data['detalle_compras']['total']?></span>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <!-- <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                Productos stock
            </div>
            <div class="card-body">
            <canvas id="stockMinimo" width="400" height="400"></canvas>
            </div>
        </div>
    </div> -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
               Productos mas vendidos
            </div>
            <div class="card-body">
            <canvas id="ProductosMasvendidos" width="400" height="400"></canvas>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"?>
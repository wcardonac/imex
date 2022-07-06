<?php
require 'config/config.php';
require 'config/database.php';
$db = new Database();

$con = $db->conectar();
 //  con este codigo vamos ha hacer consultas preparadas
$sql = $con->prepare("SELECT id, nombre, precio from productos where activo=1 ");
//vamos a ejecutar la variable o la consulta que tenemos en esa variable
$sql->execute();
//vamos a traer a todos los productos que esten en esa tabla
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);//CON ESTO ESTAMOS consiltado tod la tabla de productos






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teinda online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
     rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link  href="css/estilos.css"rel="stylesheet">
</head>
<body>
    <header>
 
        <div class="navbar navbar-expand-lg navbar-dark bg-dark ">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <strong>Tieda online</strong>
                </a>
                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" 
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarHeader">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" class="nav-link active">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">contacto</a>
                        </li>
                    </ul>
                    <a href="carrito.php" class="btn btn-primary">Carrito</a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) {?>  
                    <div class="col">
                        <div class="card shadow-sm">
                            <?php
                                $id = $row['id'];
                                $imagen = "images/productos/". $id . "/principal.jpg";
                            
                                if (!file_exists($imagen)) {
                                    $imagen= "images/no-photo.jpg";
                                }
                            
                            ?>
                            <img class="d-block w-100" src="<?php echo $imagen?>" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?php  echo $row['nombre']?></h5>
                                <p class="card-text">$<?php  echo number_format($row['precio'],2, '.', ',') ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="detalles.php?id=<?php echo $row['id'];?>&token=<?php echo hash_hmac('sha1',$row['id'], KEY_TOKEN); ?>" class=" btn btn-primary">detalles</a>
                                    </div>
                                    
                                    <a href="" class=" btn btn-success">agregar</a>
                                </div>
                            </div>
                        </div>

                    </div>
               <?php } ?>
                </div> 
               
        </div>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
 crossorigin="anonymous"></script>
</body>
</html>
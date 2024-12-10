<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Borrar usuario</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    require_once('databasePDO.php');
                    if (!empty($_GET)) { //Si el GET no esta vacío, el $id es el id que viene en el GET
                        $id = $_GET['id'];
                        if (!empty($id)){ //Si el id no está vacio, el resultado es que se lo mando a mi funcion borrar usuario
                            $resultado = borrarUsuario($id);

                            if($resultado){
                                echo '<div class ="alert alert-success" role="alert">Usuario borrado correctamente.</div>';

                            }else{
                                echo '<div class="alert alert-danger" role="alert">No se pudo borrar el usuario.</div>';
                            }
                        }else{
                            echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la informacion.</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert">Debes acceder al traves del listado de usuarios.</div>';

                    }





                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>


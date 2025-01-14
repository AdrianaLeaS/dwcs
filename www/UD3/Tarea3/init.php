<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    /*En esta clase init lo que se hace es iniciar la aplicacion. Se crea la base de datos y las tablas*/
    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Menú</h2>
                    
                </div>

                <div class="container justify-content-between">
                    <?php
                        require_once('database.php');
                        $resultado = crearDB();
                        if ($resultado){
                            echo '<div class = "alert alert-success" role="alert">';
                            
                        }else {
                            echo '<div class = "alert alert-warning" role="alert">';
                        }
                        echo $resultado ;
                        echo '</div>';

                        $resultado = crearTablaUsuarios();
                        if ($resultado) {
                            echo '<div class = "alert alert-success" role="alert"';
                        }else{
                            echo '<dic class = "alert alert-warning" role= "alert">';
                        }
                        echo $resultado;
                        echo '</div>';

                        $resultado = crearTablaTareas();
                        if ($resultado){
                            echo '<div class= "alert alert-success" role = "alert">';
                        }else{
                            echo '<div class = "alert alert-warning" role="alert">';
                        }
                        echo $resultado;
                        echo '</div>';

                        
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
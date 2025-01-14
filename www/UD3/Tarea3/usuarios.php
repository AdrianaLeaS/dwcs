<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD3. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Usuarios</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                    require_once('databasePDO.php');
                    $resultado = listaUsuarios();
                    
                    ?>
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($resultado)){
                        
                        
                          foreach($resultado as $usuario){
                            echo '<tr>';
                            echo '<td>'.$usuario['id'].'</td>';
                            echo '<td>'.$usuario['nombre'].'</td>';
                            echo '<td>'.$usuario['apellidos'].'</td>';
                            echo '<td>'.$usuario['username'].'</td>';
                            echo '<td>';
                            echo '<a class="btn btn-outline-success" href="editaUsuarioForm.php?id='.$usuario['id'].'"role="button">Editar</a>';
                            echo '<a class="btn btn-outline-danger" href="borrarUsuario.php?id='.$usuario['id'].'"role="button">Borrar</a>';
                            echo '</td>';
                            echo '</tr>';
                          }
                        }else {
                          echo 'No hay usuarios';
                        }
                        ?>
                      </tbody>
                      </table>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
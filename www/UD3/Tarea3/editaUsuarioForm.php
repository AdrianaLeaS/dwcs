//Recibe el id, recupera los datos y los muestra, y envia el formulario a editausuario.php.

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
                    <h2>Edita usuario</h2>
                </div>

                <div class="container justify-content-between">
                 <form action = "editaUsuario.php" method = "POST">

                    <label for="nombre" class="form-label" >Nombre</label>
                    <input   type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre)?($nombre): '' ?> " required>

                    <label for="apellidos" class="form-label" >Apellidos</label>
            
                    <input   type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo isset($apellidos)?($apellidos): '' ?> " required>                  

                    <label for="username" class="form-label" >Username</label>
                    <input   type="text" class="form-control" id="username" name="username" value="<?php echo isset($username)?($username): '' ?> " required>
                   
                    <label for="contrasena" class="form-label" >Contraseña</label>
                    <input   type="password" class="form-control" id="contrasena" name="contrasena" value="<?php echo isset($contrasena)?($contrasena): '' ?> " required>
                   
                    <button type="submit" class="btn btn-primary">Guardar</button>
                
                </form>
                   


                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('footer.php'); ?>
    
</body>
</html>
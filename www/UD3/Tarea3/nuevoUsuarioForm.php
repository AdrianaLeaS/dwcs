//Muestra un formulario para dar de alta nuevos usuarios

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
                    <h2>Nuevo usuario</h2>
                </div>

                <div class="container justify-content-between">
                 <form action = "nuevoUsuario.php" method = "POST">
                    <?php include_once('nuevoUsuario.php'); ?>

                    <label for="nombre" class="form-label" >Nombre</label>
                    <input   type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($nombre)?($nombre): '' ?> " required>

                    <label for="apellido" class="form-label" >Apellido</label>
                    <input   type="text" class="form-control" id="apellido" name="apellido" value="<?php echo isset($apellido)?($apellido): '' ?> " required>                  

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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        include('header.php');
    ?>
    <div class="container-fluid">
        <div class="row">
    <?php
        include('menu.php');
    ?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nueva tarea</h2>
                </div>
                <div class="container">
                <form class="mb-5" action="nueva.php" method="post">
    <div class="mb-3">
        <label class="form-label">Identificador</label>
        <input class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Descripción</label>
        <input class="form-control">
    </div>
        Estado
        <select class="form-select">
            <option>Pendiente</option>
            <option>En proceso</option>
            <option>Realizada</option>
            
        </select>
    <br>
    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </main>
        </div>
    </div>

    <?php
        include('footer.php');
    ?>
</body>
</html>



    <!--Hay que hacerla igual a lapagina de inicio de estrctura.-->
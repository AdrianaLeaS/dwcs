<html>
    <head>
    <title>DWCS UD2. Boletín 2. Solución</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid">
            <h1>Anexo 2. Arrays y estructuras de control</h1>
            <br />
            <h3>Tarea 1. Uso de arrays</h3> 
            <p>1. Almacena en un array los 10 primeros números pares. Imprímelos cada uno en una línea.</p>

                <?php
                $pares = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20];
                
                for ($i=0; $i < count($pares); $i++) {
                    echo $pares[$i].'<br />';
                }
                ?>
            <p>2. Imprime los valores del array asociativo siguiente usando un foreach:</p>
                <?php
                //Aquí v es el nombre del array.
                $v[1]=90;
                $v[10] = 200;
                $v['hola']=43; // 
                $v[9]='e';

                foreach ($v as $valor)/*Recorre el array v como valor*/ {
                    echo $valor. '<br />'; //Imprime el valor
                }
                ?>

            <h3>Tarea 2. Arrays multidimensionales</h3> 
            <p>1.Almacena la siguiente información en un array multidimensional e imprímela usando bucles.</p>

            <?php
            $usuarios = [
                'name' => john,
                'data' =>
                ['email' => 'john@demo.com',
                'website' => 'www.john.com',
                'age' => 22,
                'password' => 'pass']
            ],
                ['name' => anna,
                'data' =>
                ['email' => 'anna@demo.com',
                'website' => 'www.anna.com',
                'age' => 24,
                'password' => 'pass']
            ],
            ['name' => peter],
            'data' =>
                ['email' => 'peter@mail.com',
                'website' => 'www.peter.com',
                'age' => 42,
                'password' => 'pass'],

                ['name' => anna,
                'data' =>

                ['email' => 'max@mail.com',
                'website' => 'www.max.com',
                'age' => 33,
                'password' => 'pass']

                ];

                foreach ($usuarios as $key => $value) {
                    echo $key.'='.$value.'<br />';
                }
            ?>

        </div>  
    </body>
</html>

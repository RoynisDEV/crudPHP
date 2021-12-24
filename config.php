<!-- archivo con los archivos de configuracion para conectar a la base de datos -->
<?php 
return[
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'tutorial_crud',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
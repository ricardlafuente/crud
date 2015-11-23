<html>
    <head>
        <title>CRUD Webservice</title>
    </head>

    <body>
        <ul>
            <?php
            $noListables = ['crud.php', 'desc.md', '.gitignore', 'README.md', 'index.php', 'logs.txt'];
            $directorio = opendir("."); //ruta actual
            while ($archivo = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
                if (!is_dir($archivo)) {//verificamos si es o no un directorio
                    if(array_search($archivo, $noListables) === false)
                        echo "<li>" . $archivo . "</li>"; //Si no es un directorio i no esta en la lista de no listables
                }
            }
            ?>
        </ul>
    </body>
</html>

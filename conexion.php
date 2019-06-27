<?php
function ConexionDB()
{
    $host ="host=localhost";
    $port ="port=5432";
    $dbname ="dbname=Prueba2";
    $user ="user=postgres";
    $password ="password=1234";

    $db = pg_connect("$host $port $dbname $user $password");
    if (!$db)
        {
            echo "Error: " .pg_last_error;
        }
    else
        {
            echo "<h3>Conexión exitosa PHP- POSTGRESQL</h3>";
            return $db;
        }
    

}

?>
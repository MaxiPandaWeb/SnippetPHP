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
            
            return $db;
        }
    

}

				$conexion= ConexionDB();
				$id_comuna = $_REQUEST['comuna'];
				$querycom = "select * from comuna where region_id =".$id_comuna;
                $resultado=pg_query($conexion,$querycom) or die ("Error en la matrix");
                $nr=pg_num_rows($resultado);
                if($nr>0)
                {
                    ?>
                        <tr>
                           <th width="100" scope="row"> </th>
                           <td width="130">
                               <select class="form-control" name="comuna_id" id="comuna_id" required>

                          

                       
                    <?php
                        while ($filas=pg_fetch_array($resultado))
                         {
                            echo "<option value=".$filas['comuna_id'].">".$filas['desc_comuna']."</option>";
                         }
                    ?>
                             
                    </select>
                          </td>
                        </tr>
                <?php
                }
                else
                    {
                        echo "No hay registros";
                    }


?>